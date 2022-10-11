<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/auth/welcome.css') }}">
</head>

<body>
    <h2>Welcome to Our Page!</h2>
    <p>
        <img src="{{ asset('images/hello-world.png') }}" alt="Hello World"><br>
    <form method="post">
        <input type="hidden" name="user" value="login">
        <input type="submit" value="Login">
    </form>
    <form method="post">
        <input type="hidden" name="user" value="register">
        <input type="submit" value="Register">
    </form>
    </p>
</body>

</html>
