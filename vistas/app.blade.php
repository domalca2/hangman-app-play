<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand">
                <img src="assets/img/logo.png" alt="" width="30" height="24">
                Ahorcado
            </a>
            <div class="container navbar-nav justify-content-end">
                @yield('navbar')
                @section('usermenu')
                <div class="nav-item dropdown">
                    <button class="nav-link dropdown-toggle btn btn-light ms-5" href="#" id="navbarDropdownMenuLink" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ (isset($usuario)) ? $usuario->getNombre() : "" }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="index.php?botonlogout">Logout</a></li>
                    </ul>
                </div>
                @show
            </div>
        </nav>
        @yield('mensaje')
        @yield('content')
        <!-- Scripts -->
        <script src="assets/js/bootstrap/bootstrap.min.js"></script>
        <script src="assets/js/jquery/jquery-3.6.0.min.js"></script>
    </body>
</html>