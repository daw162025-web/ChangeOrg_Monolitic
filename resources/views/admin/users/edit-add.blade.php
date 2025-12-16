@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Editar Usuario #{{ $user->id }}</h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Rol de Usuario</label>
                        <select name="role_id" class="form-select">
                            <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Usuario Normal (1)</option>
                            <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Administrador (2)</option>
                        </select>
                        <small class="text-muted">Cuidado: Dar rol de Administrador da acceso total al panel.</small>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </div>
@endsection
