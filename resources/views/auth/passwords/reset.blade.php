@extends('layouts.navApp')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center mt-4 p-4">
        <div class="col-12 col-md-2 col-lg-4"></div>
        <div class="col-12 col-md-8 col-lg-4 login-container" style="padding: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            <h2 class="text-center">Restablecer Contraseña</h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo :</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required placeholder="Ingresa tu correo">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña :</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Ingresa tu nueva contraseña">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirmar Contraseña :</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Ingresa nuevamente tu nueva contraseña">
                </div>
                <button type="submit" class="btn btn-primary w-100">Restablecer Contraseña</button>
            </form>
        </div>
        <div class="col-12 col-md-2 col-lg-4"></div>
    </div>
</div> 
@endsection
