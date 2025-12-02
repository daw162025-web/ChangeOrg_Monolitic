@extends('layouts.public')
@section('content')

    <div class="container my-5">

        <h2 class="mb-4">Peticiones</h2>

        {{-- CORRECCIÓN 1: El 'row' debe envolver al bucle, no estar dentro --}}
        <div class="row g-4">

            @foreach($petitions as $petition)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100 d-flex flex-column shadow-sm">

                        {{-- CORRECCIÓN 2: Lógica de la imagen --}}
                        {{-- Comprobamos si la petición tiene archivos subidos --}}
                        @if($petition->files->count() > 0)
                            {{-- Usamos el primer archivo asociado --}}
                            <img src="{{ asset('petitions/' . $petition->files->first()->file_path) }}"
                                 class="card-img-top"
                                 alt="{{ $petition->title }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            {{-- Imagen por defecto si no hay ninguna subida --}}
                            <img src="{{ asset('assets/imagenes/peticion4.jpg') }}"
                                 class="card-img-top"
                                 alt="Imagen por defecto"
                                 style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column flex-grow-1">

                            <small class="text-muted">
                                Patrocinado por {{ $petition->user->name ?? 'Anónimo' }}
                            </small>

                            <h5 class="card-title my-2 fs-6 fw-bold">{{ $petition->title }}</h5>

                            {{-- Limitamos la descripción para que no rompa la tarjeta --}}
                            <p class="card-text my-2 fs-6 text-muted">
                                {{ Str::limit($petition->description, 100) }}
                            </p>

                            <div class="mt-auto pt-3">
                                <div class="d-flex align-items-center text-muted mb-2">
                                <span class="ms-1 fw-bold" style="color: rgb(1, 1, 119);">
                                    {{ $petition->signeds }} firmas
                                </span>
                                </div>

                                {{-- Enlace para ver el detalle (show) --}}
                                <a href="{{ route('petitions.show', $petition->id) }}" class="btn btn-petition w-100 text-white" style="background-color: #ec2c22; border:none;">
                                    Firma esta petición
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div> {{-- Fin del row --}}
    </div>

@endsection
