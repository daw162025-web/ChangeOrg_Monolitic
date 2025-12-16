@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Listado de Categorías</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nueva Categoría
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="ps-4">{{ $category->id }}</td>
                        <td class="fw-bold">{{ $category->name }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                {{-- Editar --}}
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                {{-- Borrar --}}
                                <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('¿Borrar categoría?');">
                                    @csrf
                                    @method('DELETE')

                                    {{-- si tiene peticiones asociadas, se deshabilita el boton--}}
                                    @if($category->petitions->count() > 0)
                                        <button type="button" class="btn btn-sm btn-secondary" disabled title="Tiene peticiones asociadas">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
