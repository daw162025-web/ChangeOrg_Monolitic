@extends('layouts.public')

@section('content')

    <div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
        <div class="card shadow" style="width: 100%; max-width: 450px;">
            <div class="card-body p-5">
                <h3 class="text-center mb-4 font-weight-bold">Iniciar Sesión</h3>

                @if (session('status'))
                    <div class="alert alert-success mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"
                               required autofocus autocomplete="username">

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
                               required autocomplete="current-password">

                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label text-secondary">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg block">
                            {{ __('Log in') }}
                        </button>
                    </div>

                    <div class="mt-3 text-center">
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none text-muted small" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <span class="text-muted">¿No tienes cuenta?</span>
                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Regístrate</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
