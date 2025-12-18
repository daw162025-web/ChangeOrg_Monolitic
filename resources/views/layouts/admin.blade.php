<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Change.org</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f4f6f9;
            overflow-x: hidden;
        }

        /* sidebar */
        .sidebar {
            min-height: 100vh;
            width: 250px;
            background-color: #ec2c22;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            display: block;
            transition: 0.3s;
            font-weight: 500;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-left: 4px solid white;
        }

        .sidebar-header {
            padding: 20px;
            background-color: rgba(0,0,0,0.1);
            text-align: center;
        }

        .user-panel {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* body */
        .content {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="d-flex">

    <nav class="sidebar">
        <div class="sidebar-header">
            <h3 class="fw-bold mb-0">change.org</h3>
        </div>

        <div class="user-panel">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/imagenes/avatar.svg') }}" class="avatar-circle border border-2 border-white me-2">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small class="text-white-50"> Administrador </small>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <small class="text-uppercase text-white-50 px-3 fw-bold" style="font-size: 0.75rem;">Main Menu</small>

            <a href="{{ route('admin.petitions.index') }}" class=" mt-2">
                <i class="bi bi-circle me-2"></i> Peticiones
            </a>
            <a href="{{ route('admin.categories.index') }}">
                <i class="bi bi-circle me-2"></i> Categorias
            </a>
            <a href="{{ route('admin.users.index') }}">
                <i class="bi bi-circle me-2"></i> Usuarios
            </a>
        </div>
        {{-- linea de separacion --}}
        <hr class="mx-3 text-white-50">

        {{-- boton para volver a la web --}}
        <a href="{{ route('home') }}" class="text-warning">
            <i class="bi bi-arrow-left-circle me-2"></i> Volver a la Web
        </a>
    </nav>

    <div class="content">
        <div class="d-flex justify-content-end align-items-center p-3 px-4 bg-white shadow-sm border-bottom">

            {{-- Dropdown del Usuario --}}
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown" aria-expanded="false">

                    <div class="text-end me-2 d-none d-sm-block">
                        <div class="fw-bold small">{{ Auth::user()->name }}</div>
                        <div class="text-muted" style="font-size: 0.75rem;">Administrador</div>
                    </div>

                    <div class="rounded-circle bg-danger text-white d-flex justify-content-center align-items-center fw-bold" style="width: 35px; height: 35px;">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person me-2 text-secondary"></i> Mi Perfil
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    {{-- logout --}}
                    <li>
                        <a class="dropdown-item py-2 text-danger fw-bold" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('top-logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Formulario oculto necesario para que funcione el botón de salir --}}
            <form id="top-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <main class="p-4">

            {{-- Mensajes de éxito/error globales--}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif


            @yield('content')

        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
