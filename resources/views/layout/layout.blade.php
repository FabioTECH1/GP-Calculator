<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <script src='{{ asset('js/bootstrap.js') }}'></script>
    <script src='{{ asset('js/ajax/jquery.js') }}'></script>

</head>

<body>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                @guest
                    <ul class="navbar-nav">
                        <li class="nav-item" style="padding: 0px 10px">
                            <h6><a class="nav-link active text-primary p-3" aria-current="page"
                                    href="{{ route('register') }}">Register</a></h6>
                        </li>
                        <li class="nav-item" style="padding: 0px 10px">
                            <h6><a class="nav-link active text-primary p-3" aria-current="page"
                                    href="{{ route('login') }}">Sign In</a></h6>
                        </li>
                    </ul>
                @endguest
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <h6 class="nav-link dropdown-toggle text-primary" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->fname }} {{ auth()->user()->mname }} {{ auth()->user()->lname }}
                            </h6>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <form action="{{ route('user.logout') }}" class="dropdown-item" method="post">
                                        @csrf
                                        <button class="btn btn-link text-decoration-none" type="submit">
                                            Sign Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
    @yield('content')

</body>

</html>
