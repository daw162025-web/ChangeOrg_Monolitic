@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Listado de Peticiones</h2>
        {{-- Botón para crear (Admin) --}}
        <a href="{{ route('admin.petitions.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nueva Petición
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                <tr class="text-muted small text-uppercase">
                    <th class="ps-4">Imagen</th>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Firmas</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($petitions as $petition)
                    <tr>
                        <td class="ps-4">
                            @if($petition->files->count() > 0)
                                <img src="{{ asset('petitions/' . $petition->files->first()->file_path) }}" class="avatar-circle" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            @else
                                <div class="avatar-circle bg-secondary d-flex align-items-center justify-content-center text-white" style="width: 40px; height: 40px; border-radius: 50%;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $petition->id }}</td>
                        <td class="fw-bold">{{ Str::limit($petition->title, 30) }}</td>
                        <td>{{ $petition->signeds }}</td>
                        <td>
                            @if($petition->status == 'accepted')
                                <span class="badge bg-success-subtle text-success">Aceptada</span>
                            @elseif($petition->status == 'pending')
                                <span class="badge bg-warning-subtle text-warning">Pendiente</span>
                            @else
                                <span class="badge bg-secondary">{{ $petition->status }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                {{-- editar --}}
                                <a href="{{ route('admin.petitions.edit', $petition->id) }}" class="btn btn-sm btn-info text-white" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                {{-- borrar si no tiene firmas --}}
                                @if($petition->signeds == 0)
                                    <form action="{{ route('admin.petitions.delete', $petition->id) }}" method="POST" onsubmit="return confirm('¿Borrar definitivamente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Borrar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-sm btn-secondary" disabled title="No se puede borrar con firmas">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
