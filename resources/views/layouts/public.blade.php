@php
    use Illuminate\Support\Facades\Auth;
@endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change.org - @yield('title', 'El cambio comienza aquí')</title>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<header>
<nav class="navbar shadow-sm navbar-expand-lg">
    <div class="container px-3">
        <a href="{{ route('home') }}" class="">
            <img src="{{ asset('assets/imagenes/Change.org_logo.svg.png') }}" style="width: 100px;" class="navbar-brand navbar-brand-custom">
        </a>

        {{-- Botón menú móvil, solo si estas logueado--}}
        <div class="d-flex align-items-center d-lg-none">
            <?php if(Auth::check()){ ?>
            <a href="{{ route('petitions.edit-add') }}" class="btn btn-petition me-2">
                Inicia una petición
            </a>
            <?php } ?>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navMain">
            {{-- Menú Izquierdo --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                {{-- OPCIONES SOLO PARA LOGUEADOS --}}
                <?php if(Auth::check()){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('petitions.mine') }}">Mis peticiones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('petitions.petitionsSigned') }}">Mis peticiones firmadas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Programa de socios/as</a>
                </li>
                <?php } ?>

                {{-- OPCIÓN PÚBLICA --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('petitions.index') }}">
                        <i class="bi bi-search"></i> Buscar
                    </a>
                </li>
            </ul>

            {{-- Menu hamburgesa --}}
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">

                <?php if(Auth::check()){ ?>

                {{-- Botón "Inicia petición" solo logueados --}}
                <li class="nav-item d-none d-lg-block me-3">
                    <a href="{{ route('petitions.edit-add') }}" class="btn btn-petition">
                        Inicia una petición
                    </a>
                </li>

                {{-- Menú de Usuario solo logueados --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="rounded-circle me-2" src="{{ asset('/assets/imagenes/avatar.svg') }}" alt="Profile" style="width: 35px; height: 35px; object-fit: cover;">
                        <span class="fw-bold"><?= Auth::user()->name ?></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header">
                            <p class="mb-1 mt-3 font-weight-semibold"><?= Auth::user()->name ?></p>
                            <p class="font-weight-light text-muted mb-0"><?= Auth::user()->email ?></p>
                        </div>

                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            Mi Perfil
                        </a>

                        @if(Auth::user()->role_id == 2)
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger fw-bold" href="{{ route('admin.home') }}">
                                <i class="bi bi-speedometer2 me-2"></i> Panel Admin
                            </a>
                        @endif

                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

                {{-- Botones Invitado solo no logueados --}}
                <?php } else { ?>

                <li class="nav-item">
                    <a class="nav-link fs-6 m-2 link-dark fw-bold" href="{{ route('login') }}">Entrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 m-2 link-dark" href="{{ route('register') }}">Registrarse</a>
                </li>

                <?php } ?>

            </ul>
        </div>
    </div>
</nav>
</header>

<main>

    @yield('content')
</main>


<footer class="mt-5 footer pt-5 pb-5">
    <div class="container">
        <div class="row gy-4">

            <div class="col-lg-3 col-md-6 px-4">
                <h5>Acerca de</h5>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Sobre Change.org</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Impacto</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Empleo</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Equipo</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 px-4">
                <h5>Comunidad</h5>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Prensa</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Normas de la Comunidad</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 px-4" >
                <h5>Ayuda</h5>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Ayuda</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Guías</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Privacidad</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Términos</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Declaración de accesibilidad</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Política de cookies</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Gestionar cookies</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 px-4">
                <h5>Redes sociales</h5>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">X</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Facebook</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">Instagram</a></li>
                    <li class="nav-item"><a href="" class="nav-link p-0 text-body-secondary">TikTok</a></li>
                </ul>
            </div>
        </div>

        <hr class="mt-4">
        <div class=""><strong> © 2025, Change.org, PBC </strong></div>
        <div>Esta web está protegida por reCAPTCHA y por Google Política de privacidad y Normas de uso.</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
