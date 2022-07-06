<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <form method="post">
        <h2>Login</h2>
        <p>Enter correct name & password:</p>
        <label for="name"><b>Username: </b></label>
        <input type="text" placeholder="Enter Username" name="name" required>
        <br>
        <label for="password"><b>Password: </b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <br>
        <button type="submit">Login</button>
        <?php if($errors->has('loginFail')) { ?>
        <span><?php echo $errors->first('loginFail'); ?></span>
        <?php } ?>
        <br>
        <a href="/forgot_password">Forgot password?</a>
    </form>
</body>

</html>
