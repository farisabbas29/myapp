<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>

<h2>Reset Password</h2>

@if($errors->any())
<ul style="color:red;">
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
@endif

<form action="{{ route('reset.password.update',$token) }}" method="POST">

@csrf

<label>New Password</label>

<br>

<input type="password" name="password">

<br><br>

<button type="submit">

Update Password

</button>

</form>

</body>
</html>
