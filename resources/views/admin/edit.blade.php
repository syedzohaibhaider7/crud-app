<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="{{ asset('css/admin/edit.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/admin/edit.js') }}"></script>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <h2>Edit</h2>
        <p>Edit information:</p>
        <img src="{{ asset('images/' . $user['image']) }}"><br><br>
        <label for="name"><b>Username: </b></label>
        <?php //if ($errors->get("name")) { ?>
        <span id="err-name">
        <?php //echo '(' . $errors->get('name')[0] . ')'; ?>
        </span>
        <?php //} ?>
        <input type="text" id="name" placeholder="Enter Username" name="name" value="<?php echo $user->name; ?>">
        <br>
        <label for="email"><b>Email: </b></label>
        <?php //if ($errors->get("email")) { ?>
        <span id="err-email">
        <?php //echo '(' . $errors->get('email')[0] . ')'; ?>
        </span>
        <?php //} ?>
        <input type="email" id="email" placeholder="Enter Email" name="email" value="<?php echo $user->email; ?>">
        <br>
        <label for="password"><b>Password: </b></label>
        <?php //if ($errors->get("password")) { ?>
        <span id="err-password">
        <?php //echo '(' . $errors->get('password')[0] . ')'; ?>
        </span>
        <?php //} ?>
        <input type="password" id="password" placeholder="Enter Password" name="password" value="<?php echo $user->password; ?>">
        <br>
        <label for="age"><b>Age: </b></label>
        <?php //if ($errors->get("age")) { ?>
        <span id="err-age">
        <?php //echo '(' . $errors->get('age')[0] . ')'; ?>
        </span>
        <?php //} ?>
        <br>
        <input type="number" id="age" placeholder="Enter Age" name="age" value="<?php echo $user->age; ?>">
        <br>
        <label for="gender"><b>Gender: </b></label>
        <?php //if ($errors->get("gender")) { ?>
        <span id="err-gender">
        <?php //echo '(' . $errors->get('gender')[0] . ')'; ?>
        </span>
        <?php //} ?>
        <br>
        <?php if ($user->gender == 'male') { ?>
        <input type="radio" name="gender" value="male" id="male" <?php echo 'checked'; ?>>Male
        <input type="radio" name="gender" value="female" id="female">Female
        <input type="radio" name="gender" value="other" id="other">Other
        <?php } else if ($user->gender == 'female') { ?>
        <input type="radio" name="gender" value="male" id="male">Male
        <input type="radio" name="gender" value="female" id="female" <?php echo 'checked'; ?>>Female
        <input type="radio" name="gender" value="other" id="other">Other
        <?php } else if ($user->gender == 'other') { ?>
        <input type="radio" name="gender" value="male" id="male">Male
        <input type="radio" name="gender" value="female" id="female">Female
        <input type="radio" name="gender" value="other" id="other" <?php echo 'checked'; ?>>Other
        <?php } ?>
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
