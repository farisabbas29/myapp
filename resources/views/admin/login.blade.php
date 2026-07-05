<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>

<h2>Admin Login</h2>

@if(session('success'))
<p style="color:green;">
    {{ session('success') }}
</p>
@endif

@if(session('error'))
<p style="color:red;">
    {{ session('error') }}
</p>
@endif

<form action="{{ route('admin.authenticate') }}" method="POST">
    @csrf

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Password</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Login</button>
</form>


<br>

<a href="{{ route('forgot.password') }}">
Forgot Password?
</a>

<br><br>

<a href="{{ route('admin.register') }}">Create Account</a>

</body>
</html>
