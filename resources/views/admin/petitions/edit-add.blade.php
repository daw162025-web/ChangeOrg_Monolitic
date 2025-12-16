@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">
                {{ isset($petition) ? 'Editar Petición #' . $petition->id : 'Crear Nueva Petición' }}
            </h2>
            <a href="{{ route('admin.petitions.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver al listado
            </a>
        </div>

        {{-- Muestra errores de validación si los hay --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                {{-- EDITAR / CREAR ADMIN --}}
                <form action="{{ isset($petition) ? route('admin.petitions.update', $petition->id) : route('admin.petitions.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    {{-- Si existe $petition, usamos el metodo PUT para actualizar --}}
                    @if(isset($petition))
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label fw-bold">Título de la petición</label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   class="form-control"
                                   value="{{ old('title', $petition->title ?? '') }}"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="destinatary" class="form-label fw-bold">Destinatario</label>
                            <input type="text"
                                   name="destinatary"
                                   id="destinatary"
                                   class="form-control"
                                   value="{{ old('destinatary', $petition->destinatary ?? '') }}"
                                   required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="category_id" class="form-label fw-bold">Categoría</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option value="" disabled {{ !isset($petition) ? 'selected' : '' }}>Selecciona una...</option>

                                @if(isset($categories))
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ (old('category_id') == $cat->id || (isset($petition) && $petition->category_id == $cat->id)) ? 'selected' : '' }}>
                                            {{ $cat->name ?? $cat->nombre }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="description" class="form-label fw-bold">Descripción</label>
                            <textarea name="description"
                                      id="description"
                                      rows="6"
                                      class="form-control"
                                      required>{{ old('description', $petition->description ?? '') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label fw-bold">Estado</label>
                            <select name="status" class="form-select">
                                <option value="pending" {{ (old('status', $petition->status ?? '') == 'pending') ? 'selected' : '' }}>Pendiente</option>
                                <option value="accepted" {{ (old('status', $petition->status ?? '') == 'accepted') ? 'selected' : '' }}>Aceptada</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="file" class="form-label fw-bold">Imagen destacada</label>
                            <input type="file" name="file" class="form-control">

                            @if(isset($petition) && $petition->files->count() > 0)
                                <div class="mt-2">
                                    <small class="text-muted">Imagen actual:</small><br>
                                    <img src="{{ asset('petitions/' . $petition->files->first()->file_path) }}"
                                         alt="Imagen actual"
                                         class="img-thumbnail mt-1"
                                         style="height: 100px;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-5">
                            {{ isset($petition) ? 'Actualizar Petición' : 'Crear Petición' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
