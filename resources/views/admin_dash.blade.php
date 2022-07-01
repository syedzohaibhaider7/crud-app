<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/admin_dash.css') }}">
</head>

<body>
    <h2>Dashboard</h2>
  <p>
    <img src="{{ asset('hello-admin.png') }}" alt="Hello Admin"><br>
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