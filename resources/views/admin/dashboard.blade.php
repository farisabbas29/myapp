<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Dashboard</h1>

<h3>Welcome {{ session('admin_name') }}</h3>

<a href="{{ route('logout') }}">
    Logout
</a>

</body>
</html>