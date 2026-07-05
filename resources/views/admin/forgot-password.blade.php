<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>

<h2>Forgot Password</h2>

@if(session('error'))
<p style="color:red;">
    {{ session('error') }}
</p>
@endif

@if(session('link'))
<p style="color:green;">
    Demo Reset Link:
</p>

<a href="{{ session('link') }}">
    {{ session('link') }}
</a>
@endif

<form action="{{ route('forgot.password.send') }}" method="POST">

    @csrf

    <label>Email</label><br>

    <input type="email" name="email">

    <br><br>

    <button type="submit">
        Generate Reset Link
    </button>

</form>

<br>

<a href="{{ route('admin.login') }}">
Back to Login
</a>

</body>
</html>
