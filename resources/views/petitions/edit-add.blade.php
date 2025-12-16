@extends('layouts.public')

@section('content')
    {{-- Mensajes de error generales --}}
    @if ($errors->any())
        <div class="alert alert-danger container mt-4" style="max-width: 620px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORMULARIO --}}
    <form method="post"
          action="{{ isset($petition) ? route('petitions.update', $petition->id) : route('petitions.store') }}"
          enctype="multipart/form-data">

        @csrf

        {{-- Si existe $petition, añadimos el metodo PUT para actualizar --}}
        @if(isset($petition))
            @method('PUT')
        @endif

        <div class="container my-5" style="max-width: 620px;">
            <h2 class="h3 fw-bold">¿Quién es el destinatario?</h2>
            <p class="text-muted">Persona, organización o lugar al que diriges la petición.</p>
            <div class="mt-4 mb-3">
                <label for="destinatary" class="form-label">Destinatario</label>
                <input type="text"
                       name="destinatary"
                       class="form-control form-control-lg @error('destinatary') is-invalid @enderror"
                       id="destinatary"
                       value="{{ old('destinatary', $petition->destinatary ?? '') }}"
                       placeholder="Ej: Alcalde de Madrid...">

                @error('destinatary')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="container my-5" style="max-width: 620px;">
            <h2 class="h3 fw-bold">Elige una categoría</h2>
            <p class="text-muted">Ayudará a clasificar tu causa.</p>
            <div class="mt-4 mb-3">
                <select name="category_id" class="form-select form-select-lg @error('category_id') is-invalid @enderror">
                    <option value="" disabled {{ !isset($petition) ? 'selected' : '' }}>Selecciona una categoría</option>

                    @if(isset($categories))
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ (old('category_id') == $cat->id || (isset($petition) && $petition->category_id == $cat->id)) ? 'selected' : '' }}>
                                {{ $cat->name ?? $cat->nombre }}
                            </option>
                        @endforeach
                    @endif
                </select>

                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="container my-5" style="max-width: 620px;">
            <h2 class="h3 fw-bold">Escribe el título de tu petición</h2>
            <p class="text-muted">Explica a la gente lo que quieres cambiar.</p>
            <div class="mt-4 mb-3">
                <label for="title" class="form-label">Título de la petición</label>
                <input type="text"
                       name="title"
                       class="form-control form-control-lg @error('title') is-invalid @enderror"
                       id="title"
                       value="{{ old('title', $petition->title ?? '') }}">

                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="container my-5" style="max-width: 620px;">
            <h2 class="h3 fw-bold">Cuenta tu historia</h2>
            <p class="text-muted">
                Empieza desde cero o utiliza la estructura que recomendamos.
            </p>
            <div class="mt-4">
                <textarea name="description"
                          class="form-control @error('description') is-invalid @enderror"
                          id="description"
                          rows="10"
                          placeholder="Empieza a escribir...">{{ old('description', $petition->description ?? '') }}</textarea>

                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="container my-5" style="max-width: 620px;">
            <h2 class="h3 fw-bold">Añade una imagen</h2>
            <p class="text-muted mb-1">{{ isset($petition) ? '(Opcional si ya tienes una)' : '(Obligatorio)' }}</p>

            <div class="dropzone-wrapper mt-4 border p-4 text-center bg-light rounded">
                <label for="fileInput" class="form-label fw-bold">Sube tu imagen aquí</label>
                <input type="file"
                       name="file"
                       class="form-control @error('file') is-invalid @enderror"
                       id="fileInput">

                @if(isset($petition) && $petition->files->count() > 0)
                    <div class="mt-3">
                        <p class="text-muted small">Imagen actual:</p>
                        <img src="{{ asset('petitions/' . $petition->files->first()->file_path) }}"
                             alt="Imagen actual"
                             class="img-fluid rounded"
                             style="max-height: 200px;">
                    </div>
                @endif

                @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end mt-5 mb-5">
                <button type="submit" class="btn btn-danger btn-lg text-white" style="background-color: #ec2c22; border:none;">
                    {{ isset($petition) ? 'Guardar cambios' : 'Finalizar petición' }}
                </button>
            </div>
        </div>

    </form>

@endsection
