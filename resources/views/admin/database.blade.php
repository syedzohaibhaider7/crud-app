<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
    <link rel="stylesheet" href="{{ asset('css/admin/database.css') }}">
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
            <th id="image">Image</th>
            <th id="role">Role</th>
            <th id="edit">Edit</th>
            <th id="delete">Delete</th>
        </tr>
        <?php
        foreach ($users as $user) { ?>
        <tr>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $user->password; ?></td>
            <td><?php echo $user->age; ?></td>
            <td><?php echo $user->gender; ?></td>
            <td><img src="{{ asset('images/' . $user->image) }}"></td>
            <td><?php echo $user->role; ?></td>
            <td><a href="/admin/edit/<?php echo $user->id; ?>" id="ed">Edit</a></td>
            <td><a href="/admin/delete/<?php echo $user->id; ?>" id="del">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
    <form method="post">
        <input type="hidden" name="admin" value="dashboard">
        <input type="submit" value="Dashboard">
    </form>
</body>

</html>
