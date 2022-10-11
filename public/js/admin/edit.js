var url = window.location.href + "/duplicate";
var nameValidation = /^([a-zA-Z])*$/;
var emailValidation = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-]))+(\.+([a-zA-Z0-9]{2,4})){1,2}$/;
var duplicate, errorName, errorMail, errorPassword, errorAge, errorGender, errorImage;
$(document).ready(function () {
    $("form").submit(function () {
        var name = $('#name').val();
        var mail = $("#email").val();
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: { "_token": "{{ csrf_token() }}", name: name, email: mail },
            async: false,
            success: function (data) {
                if (data.success == "dupBoth") {
                    $("#err-name").show();
                    $("#err-name").html("(Name already taken.)");
                    $("#err-email").show();
                    $("#err-email").html("(Email already registered.)");
                } else if (data.success == "dupName") {
                    $("#err-name").show();
                    $("#err-name").html("(Name already taken.)");
                    $("#err-email").hide();
                } else if (data.success == "dupEmail") {
                    $("#err-name").hide();
                    $("#err-email").show();
                    $("#err-email").html("(Email already registered.)");
                }
                duplicate = true;
            },
            error: function () {
                duplicate = false;
            }
        });

        if (name.length == 0) {
            $("#err-name").show();
            $("#err-name").html("(Name is required.)");
            errorName = true;
        } else if (name.length > 50) {
            $("#err-name").show();
            $("#err-name").html("(Name must be at most 50 characters long.)");
            errorName = true;
        } else if (!nameValidation.test(name)) {
            $("#err-name").show();
            $("#err-name").html("(Only alphabets are allowed.)");
            errorName = true;
        } else if (duplicate == true) {
            errorName = true;
        } else {
            $("#err-name").hide();
            errorName = false;
        }

        if (mail.length == 0) {
            $("#err-email").show();
            $("#err-email").html("(Email is required.)");
            errorMail = true;
        } else if (!emailValidation.test(mail)) {
            $("#err-email").show();
            $("#err-email").html("(Enter valid email.)");
            errorMail = true;
        } else if (duplicate == true) {
            errorMail = true;
        } else {
            $("#err-email").hide();
            errorMail = false;
        }

        let password = $("#password").val();
        if (password.length == 0) {
            $("#err-password").show();
            $("#err-password").html("(Password is required.)");
            errorPassword = true;
        } else if (password.length < 6) {
            $("#err-password").show();
            $("#err-password").html("(Password must be at least 6 characters long.)");
            errorPassword = true;
        } else if (password.length > 12) {
            $("#err-password").show();
            $("#err-password").html("(Password must be at most 12 characters long.)");
            errorPassword = true;
        } else {
            $("#err-password").hide();
            errorPassword = false;
        }

        let userAge = $("#age").val();
        if (userAge.length == 0) {
            $("#err-age").show();
            $("#err-age").html("(Age is required.)");
            errorAge = true;
        } else if ((userAge < 1) || (userAge > 150)) {
            $("#err-age").show();
            $("#err-age").html("(Enter valid age.)");
            errorAge = true;
        } else {
            $("#err-age").hide();
            errorAge = false;
        }

        let userGender = $("input[name=gender]").is(':checked');
        if (userGender == false) {
            $("#err-gender").show();
            $("#err-gender").html("(Gender is required.)");
            errorGender = true;
        } else {
            $("#err-gender").hide();
            errorGender = false;
        }

        let imageName = $("#image").val();
        if (imageName != "") {
            var extension = $("#image").val().split(".").pop().toLowerCase();
            if ($.inArray(extension, ["gif", "png", "jpg", "jpeg", "svg"]) == -1) {
                $("#err-image").show();
                $("#err-image").html("(Upload valid image.)");
                errorImage = true;
            } else {
                $("#err-image").hide();
                errorImage = false;
            }
        }

        if ((duplicate == true) || (errorName == true) || (errorMail == true) || (errorPassword == true) || (errorAge == true) || (errorGender == true) || (errorImage == true)) {
            return false;
        }
    });
});