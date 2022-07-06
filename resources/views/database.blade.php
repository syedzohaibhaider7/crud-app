<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
    <link rel="stylesheet" href="{{ asset('css/database.css') }}">
</head>

<body>
    <h2>Database</h2>
    <table>
        <tr>
            <th id="name">Username</th>
            <th id="email">Email</th>
            <th id="password">Password</th>
            <th id="age">Age</th>
            <th id="gender">Gender</th>
            <th id="role">Role</th>
        </tr>
        <?php
        foreach ($users as $user) { ?>
        <tr>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $user->password; ?></td>
            <td><?php echo $user->age; ?></td>
            <td><?php echo $user->gender; ?></td>
            <td><?php echo $user->role; ?></td>
        </tr>
        <?php } ?>
    </table>
    <form method="post">
        <input type="hidden" name="admin" value="dashboard">
        <input type="submit" value="Dashboard">
    </form>
</body>

</html>
