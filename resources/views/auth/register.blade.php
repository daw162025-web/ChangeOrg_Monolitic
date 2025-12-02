@extends('layouts.public')

@section('content')

    <div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
        <div class="card shadow" style="width: 100%; max-width: 500px;">
            <div class="card-body p-5">
                <h3 class="text-center mb-4 font-weight-bold">Crear una cuenta</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}"
                               required autofocus autocomplete="name">

                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"
                               required autocomplete="username">

                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               required autocomplete="new-password">

                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" type="password"
                               class="form-control"
                               name="password_confirmation"
                               required autocomplete="new-password">

                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('Register') }}
                        </button>
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <span class="text-muted">{{ __('Already registered?') }}</span>
                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold">
                            Inicia sesión aquí
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
