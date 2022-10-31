<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sign.css') }}">
    <title>Sign In</title>
</head>
<body>
<div class="container">
    <div class="wrapper">
        <div class="row">
            <div class="form-wrapper col-12 col-md-10 col-lg-6 m-auto">
                <form action="{{ route('user.login') }}" method="POST" class="position-relative form">
                    <a href="{{ route('user.registration') }}" class="">Don't you have an account? Sign up</a>
                    @csrf
                    <div class="input-group">
                        <input type="text" class="@error('email') is-invalid @enderror email text form-control" name="email" placeholder="E-mail">
                        @error('email')
                        <p class="invalid-tooltip">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-group">
                        <input type="password" class="@error('password') is-invalid @enderror password text form-control" name="password" placeholder="Password">
                        @error('password')
                        <p class="invalid-tooltip">{{ $message }}</p>
                        @enderror
                        @error('registration error')
                        <p class="invalid-tooltip">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" class="submit btn" value="Sign in">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
