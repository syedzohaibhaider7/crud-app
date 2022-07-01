<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <form method="post">
        <h2>Register</h2>
        <p>Add a new user:</p>
        <label for="name"><b>Username: </b></label>
        <?php if ($errors->get("name")) { ?>
            <span><?php 
            {{ echo "(".$errors->get("name")[0].")"; }} ?></span>
        <?php } ?>
        <input type="text" placeholder="Enter Username" name="name" >
        <br>
        <label for="email"><b>Email: </b></label>
        <?php if ($errors->get("email")) { ?>
            <span><?php 
            {{ echo "(".$errors->get("email")[0].")"; }} ?></span>
        <?php } ?>
        <input type="email" placeholder="Enter Email" name="email" >
        <br>
        <label for="password"><b>Password: </b></label>
        <?php if ($errors->get("password")) { ?>
            <span><?php 
            {{ echo "(".$errors->get("password")[0].")"; }} ?></span>
        <?php } ?>
        <input type="password" placeholder="Enter Password" name="password" >
        <br>
        <label for="age"><b>Age: </b></label>
        <?php if ($errors->get("age")) { ?>
            <span><?php 
            {{ echo "(".$errors->get("age")[0].")"; }} ?></span>
        <?php } ?>
        <input type="number" placeholder="Enter Age" name="age" >
        <br>
        <label for="gender"><b>Gender: </b></label>
        <?php if ($errors->get("gender")) { ?>
            <span><?php 
            {{ echo "(".$errors->get("gender")[0].")"; }} ?></span>
        <?php } ?>
        <br>
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender" value="other">Other
        <br>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>
</body>

</html>