<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/sign.css') }}">
    <title>Sign Up</title>
</head>
<body>
<div class="wrapper">
    <div class="form">
        <a href="{{ route('user.login') }}" class="">Do you have an account? Sign in</a>
        <form action="{{ route('user.registration') }}" method="POST">
            @csrf
            <input type="text" class="email text" name="email" placeholder="E-mail">
            @error('email')
            <p>{{ $message }}</p>
            @enderror
            <input type="password" class="password text" name="password" placeholder="Password">
            @error('password')
            <p>{{ $message }}</p>
            @enderror
            @error('registration error')
            <p>{{ $message }}</p>
            @enderror
            <input type="submit" class="submit" value="Sign up">
        </form>
    </div>
</div>
</body>
</html>
