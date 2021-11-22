<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MustaKa</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div id="main">

        <header>
            <div class="banner">
                <div class="logo-div">
                    <img src="imgs/wave.png" alt="logo" />
                </div>
                <div>
                    <h1>MustaKa, <span class="username">{{ Auth::user()->name }}</span>?</h1>
                    <form action="/" method="get">
                        <button>Kubo</button>
                    </form>
                    <form action="/friends" method="get">
                        <button>Friend List</button>
                    </form>
                    <form action="/friendrequests" method="get">
                        <button>Friend Requests</button>
                    </form>
                    <form action="/search" method="get">
                        <button>Search</button>
                    </form>
                    <form action="/logout" method="post">
                        @csrf
                        <button>Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <div class="accounts-body">
            @foreach ($accounts as $account)
                <div class="account-box">
                    <div>
                        <img src="./imgs/users-pic/{{ $account->name }}.png" alt="profile pic" />
                    </div>
                    <div>
                        <div class="account-name">{{ $account->name }}</div>
                        <form action="/friendrequests/{{ $account->id }}" method="post">
                            @csrf
                            <button>Add</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</body>

</html>
