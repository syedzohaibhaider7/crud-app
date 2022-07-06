<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password?</title>
    <link rel="stylesheet" href="{{ asset('css/forgot_password.css') }}">
</head>

<body>
    <form method="post">
        <h2>Forgot Password?</h2>
        <p>Enter your email that is registered to our page.</p>
        <label for="email"><b>Email: </b></label>
        <input type="email" placeholder="Enter Email" name="email">
        <p>We will send your username and password on this email.</p>
        <?php if($errors->has('notRegister')) { ?>
        <span><?php echo $errors->first('notRegister'); ?></span>
        <?php } ?>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>
