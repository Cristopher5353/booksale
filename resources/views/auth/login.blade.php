@extends('layouts.navApp')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center mt-4 p-4">
        <div class="col-12 col-md-2 col-lg-4"></div>
        <div class="col-12 col-md-8 col-lg-4 login-container" style="padding: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            <h2 class="text-center">Iniciar Sesión</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Correo :</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autofocus placeholder="Ingresa tu correo">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña :</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Ingresa tu contraseña">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Recordarme</label>
                    </div>
                    <div>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">¿Olvistaste tu contraseña?</a>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
            </form>
        </div>
        <div class="col-12 col-md-2 col-lg-4"></div>
    </div>
</div> 
@endsection
