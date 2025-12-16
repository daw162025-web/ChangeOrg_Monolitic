@extends('layouts.public')
@section('content')
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="container mt-4">
        <h1 class="tituloPrincipal my-3 mb-5" style="font-weight: 700;">{{$petition->title}}</h1>
        @auth
             @if(Auth::id() == $petition->user_id)
            <div class="mb-5 p-3 rounded shadow-sm border" style="background-color: #fdfdfe; border-left: 5px solid #ffc107 !important;">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <div class="mb-2 mb-md-0">
                        <strong>👋 Hola, {{ Auth::user()->name }}</strong>.
                        <span class="text-muted small">Eres el creador de esta petición.</span>
                    </div>

                    <div class="d-flex gap-2">
                        {{-- editar --}}
                            <a href="{{ route('petitions.edit', $petition->id) }}" class="btn btn-outline-dark btn-sm">
                                <i class="bi bi-pencil"></i> Editar Petición
                            </a>

                            {{-- Bborrar  --}}
                            @if($petition->signeds == 0)
                                <form action="{{ route('petitions.destroy', $petition->id) }}" method="POST"
                                      onsubmit="return confirm('¿Estás seguro de que quieres borrar tu petición permanentemente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i> Borrar
                                    </button>
                                </form>
                            @else
                                {{-- Botón desactivado si tiene firmas --}}
                                <button class="btn btn-outline-secondary btn-sm" disabled title="No puedes borrarla porque ya tiene apoyos">
                                    <i class="bi bi-trash"></i> Borrar (Tiene firmas)
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
              @endif
        @endauth
        <div class="row g-4">
            <div class="col-md-4 order-md-2 px-4">
                <div class="sticky-lg-top" style="top: 20px;">
                    <div class="card shadow-sm border-0 form-card-con-fondo">
                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                {{-- Contador de firmas --}}
                                <span class="display-5 fw-bold">{{$petition->signeds}}</span>
                                <div class="text-muted">Firmas verificadas</div>
                            </div>

                            @auth
                                {{-- usuarios logueados --}}
                                <div class="mb-3 text-center">
                                    <p class="text-muted small mb-1">Firmando como:</p>
                                    <h5 class="fw-bold">{{ Auth::user()->name }}</h5>
                                    <p class="small text-muted">{{ Auth::user()->email }}</p>
                                </div>

                                @if($petition->userSigners->contains(Auth::user()->id))
                                    <div class="alert alert-success text-center">
                                        <h4 class="fw-bold">¡Firmado! ✓</h4>
                                        <p class="small mb-0">Ya has apoyado esta causa.</p>
                                    </div>
                                    <button class="btn btn-secondary w-100 fw-bold fs-5" disabled>
                                        Firma registrada
                                    </button>

                                @else
                                    {{-- si no esta firmado --}}
                                    <form action="{{ route('petitions.sign', $petition->id) }}" method="POST">
                                        @csrf
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="mostrarPublico" checked>
                                            <label class="form-check-label small" for="mostrarPublico">
                                                Mostrar mi firma públicamente
                                            </label>
                                        </div>

                                        <button type="submit" class="btn btn-lg w-100 fw-bold fs-5 text-danger" style="background-color: #fde100; border-color: #fde100; color: #333 !important;">
                                            🖋️ Firma la petición
                                        </button>
                                    </form>
                                @endif

                            @else
                                {{-- usuarios invitados --}}
                                <h4 class="fw-bold mb-3">Firma esta petición</h4>
                                <p class="small">Necesitas iniciar sesión para poder firmar y apoyar esta causa.</p>

                                <a href="{{ route('login') }}" class="btn btn-lg w-100 fw-bold fs-5 text-white" style="background-color: #ec2c22; border: none;">
                                    Inicia sesión para firmar
                                </a>
                                <div class="text-center mt-3">
                                    <a href="{{ route('register') }}" class="small text-muted">¿No tienes cuenta? Regístrate</a>
                                </div>

                            @endauth

                            <p class="small text-muted mt-3 mb-0 text-center">
                                Procesamos tus datos de acuerdo con nuestra
                                <a href="#">Política de privacidad</a>.
                            </p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 order-md-1">

                <div class="mb-4 text-center">
                    @if($petition->files->count() > 0)
                        <img class="img-fluid rounded"
                             src="{{ asset('petitions/' . $petition->files->first()->file_path) }}"
                             alt="{{ $petition->title }}"
                             style="width: 100%; max-height: 500px; object-fit: cover;">
                    @else
                        <img class="img-fluid rounded"
                             src="{{ asset('assets/imagenes/peticion4.jpg') }}"
                             alt="Imagen por defecto"
                             style="width: 100%; max-height: 500px; object-fit: cover;">
                    @endif
                </div>

                <hr>
                <div class="mb-4">
                    <h2 class="tituloPrincipal3">El problema</h2>
                    <p class="mt-4">{{$petition->description}}</p>
                </div>

                <div class="container my-4">
                    <hr>
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center mb-3 mb-md-0">
                            <img src="{{asset('assets/imagenes/avatar.svg')}}"
                                 class="card-img-top rounded-circle mx-auto mt-3"
                                 style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="ms-3">
                                <div class="fw-bold">{{ $petition->user->name ?? 'Anónimo' }}</div>
                                <div class="text-muted">Creador de la petición</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
