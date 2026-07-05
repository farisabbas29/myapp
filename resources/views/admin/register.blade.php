<!DOCTYPE html>
<html>
<head>
    <title>Admin Register</title>
</head>
<body>

<h2>Admin Registration</h2>

@if($errors->any())
<ul style="color:red;">
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

<form action="{{ route('admin.store') }}" method="POST">
    @csrf

    <label>Name</label><br>
    <input type="text" name="name"><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Password</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Register</button>
</form>

<a href="{{ route('admin.login') }}">Already registered? Login</a>

</body>
</html>
