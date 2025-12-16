@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Listado de Usuarios</h2>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Firmas</th> <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="ps-4">{{ $user->id }}</td>
                        <td class="fw-bold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role_id == 2)
                                <span class="badge bg-danger">Admin</span>
                            @else
                                <span class="badge bg-secondary">User</span>
                            @endif
                        </td>
                        <td>{{ $user->signedPetition->count() }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                {{-- Editar --}}
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                {{-- Borrar --}}
                                {{-- Bloqueamos el botón si es él mismo O si tiene firmas --}}
                                @if(Auth::id() == $user->id || $user->signedPetition->count() > 0)
                                    <button class="btn btn-sm btn-secondary" disabled title="No se puede borrar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @else
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('¿Borrar usuario definitivamente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
