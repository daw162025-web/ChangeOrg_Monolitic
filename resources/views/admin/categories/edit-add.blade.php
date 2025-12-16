@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            {{ isset($category) ? 'Editar Categoría' : 'Nueva Categoría' }}
        </h2>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nombre de la Categoría</label>
                    <input type="text" name="name" id="name" class="form-control"
                           value="{{ old('name', $category->name ?? '') }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($category) ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
