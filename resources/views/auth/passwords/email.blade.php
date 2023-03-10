@extends('layouts.navApp')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center mt-4 p-4">
        <div class="col-12 col-md-2 col-lg-4"></div>
        <div class="col-12 col-md-8 col-lg-4 login-container" style="padding: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <h2 class="text-center">Restablecer Contraseña</h2>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Correo :</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required placeholder="Ingresa tu correo">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Enviar enlace para restablecer contraseña</button>
            </form>
        </div>
        <div class="col-12 col-md-2 col-lg-4"></div>
    </div>
</div> 
@endsection
