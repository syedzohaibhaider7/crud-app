<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>

<body>
    <h2>Dashboard</h2>
    <p>
        <img src="{{ asset('images/' . $data['image']) }}" alt="Hello Admin"><br><br>
        Your details are as follows:<br>
        <b>Name:</b> {{ $data['name'] }}<br>
        <b>Email:</b> {{ $data['email'] }}<br>
        <b>Password:</b> {{ $data['password'] }}<br>
        <b>Age:</b> {{ $data['age'] }}<br>
        <b>Gender:</b> {{ $data['gender'] }}<br>
    <form method="post">
        <input type="hidden" name="admin" value="addAdmin">
        <input type="submit" value="Add Admin">
    </form>
    <form method="post">
        <input type="hidden" name="admin" value="database">
        <input type="submit" value="Database">
    </form>
    <form method="post">
        <input type="hidden" name="admin" value="logout">
        <input type="submit" value="Logout">
    </form>
    </p>
</body>

</html>
