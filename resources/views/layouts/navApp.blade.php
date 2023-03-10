<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="/css/layouts/navApp.css">
    <link rel="shortcut icon" href="/images/default/favicon.png" type="image/x-icon">
    @yield('css')
    <title>BookSale</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm" id="navBar">
        <div class="container-fluid">
            <a class="navbar-brand ms-1" href="{{route('index')}}"><i class="fa-solid fa-book text-primary icon-book"></i> BookSale</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav mx-auto"></ul>
                <ul class="navbar-nav me-1">
                    <li class="nav-item dropdown me-3">
                        @guest
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-regular fa-user icon-user"></i> Mi Cuenta
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li><a class="dropdown-item" href="{{route('login')}}">Iniciar Sesión</a></li>
                                <li><a class="dropdown-item" href="{{route('register')}}">Registrarme</a></li>
                            </ul>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" href="{{route('cart')}}"><i class="fa-solid fa-bag-shopping text-primary"></i> Carrito</a>
                            </li>
                            @if(Auth::user()->role->id == 1)
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{route('dashboard')}}"><i class="fa-solid fa-gauge text-primary"></i> Dashboard</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown me-1">
                                <a class="nav-link dropdown-toggle active" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user text-primary"></i> {{ Auth::user()->name }} {{ Auth::user()->surname }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                    <li><a class="dropdown-item" href="{{route('editProfile', Auth::user()->id)}}">Perfil</a></li>
                                    <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </a></li>
                                </ul>
                            </li>
                        @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
    @yield('js')
</body>
</html>