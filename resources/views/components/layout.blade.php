<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>{{$title}}</title>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-auto logo">
                    <a href="{{ route('mainPage') }}" class="d-flex justify-content-start">
                        <x-icon.link/>
                        <span class="logo-title">ShrtLnk</span>
                    </a>
                </div>
                <div class="col user d-flex align-items-center justify-content-end">
                    @auth
                        <div class="auth">
                            <a href="{{ route('user.dashboard') }}">
                                <x-icon.user/>
                                <span>Personal account</span>
                            </a>
                        </div>
                    @endauth
                    @guest
                        <div class="guest">
                            <a href="{{ route('user.login') }}" class="mr-1">Sign in</a>
                            <a href="{{ route('user.registration') }}">Sign up</a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        {{ $slot }}
    </div>
</body>
</html>
