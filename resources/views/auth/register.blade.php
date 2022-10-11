<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/auth/register.js') }}"></script>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <h2>Register</h2>
        <p>Add a new user:</p>
        <label for="name"><b>Username: </b></label>
        <span id="err-name"></span>
        <input type="text" id="name" placeholder="Enter Username" name="name">
        <br>
        <label for="email"><b>Email: </b></label>
        <?php //if ($errors->get("email")) { ?>
        <span id="err-email">
        <?php //echo '(' . $errors->get('email')[0] . ')'; ?>
        </span>
        <?php //} ?>
        <input type="email" id="email" placeholder="Enter Email" name="email">
        <br>
        <label for="password"><b>Password: </b></label>
        <?php //if ($errors->get("password")) { ?>
        <span id="err-password">
        <?php //echo '(' . $errors->get('password')[0] . ')'; ?>
        </span>
        <?php //} ?>
        <input type="password" id="password" placeholder="Enter Password" name="password">
        <br>
        <label for="age"><b>Age: </b></label>
        <?php //if ($errors->get("age")) { ?>
        <span id="err-age">
        <?php //echo '(' . $errors->get('age')[0] . ')'; ?>
        </span>
        <?php //} ?>
        <br>
        <input type="number" id="age" placeholder="Enter Age" name="age">
        <br>
        <label for="gender"><b>Gender: </b></label>
        <?php //if ($errors->get("gender")) { ?>
        <span id="err-gender">
        <?php //echo '(' . $errors->get('gender')[0] . ')'; ?>
        </span>
        <?php //} ?>
        <br>
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender" value="other">Other
        <br>
        <label for="image"><b>Image: </b></label>
        <?php //if ($errors->get("image")) { ?>
        <span id="err-image">
        <?php //echo '(' . $errors->get('image')[0] . ')'; ?>
        </span>
        <?php //} ?>
        <br>
        <input type="file" id="image" name="image">
        <br>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>
</body>

</html>
