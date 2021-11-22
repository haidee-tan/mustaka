<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MustaKa</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="welcome-box">
        @if (Route::has('login'))
            <div class="sub-box">
                <div class="welcome-banner">
                    <div class="logo-div">
                        <img src="imgs/wave.png" alt="logo" />
                    </div>
                    <h1>MustaKa<span class="quest-mark">?</span></h1>
                </div>
                @auth
                    <a href="{{ url('/') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
</body>

</html>
