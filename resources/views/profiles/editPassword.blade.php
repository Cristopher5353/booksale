@extends(($user->role_id == 1) ?'layouts.dashBoard' :'layouts.navApp')

@section('css')
    <link rel="stylesheet" href="/css/profiles/editPassword.css">
@endsection

@section('content')
    @if($user->role_id == 1)
    <h1 class="text-center title-editpassword-dashboard">Cambiar Contraseña</h1>
    @else
    <h1 class="text-center title-editpassword-user">Cambiar Contraseña</h1>
    @endif
    <div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-3"></div>
			<div class="col-12 col-md-5">
                @if(session('message'))
                    <div class="alert alert-primary alert-dismissible fade show mb-3" role="alert">
                        {{session('message')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{route('updatePassword', $user->id)}}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Contraseña Actual</label>
                        <input type="password" name="currentPassword" autofocus class="form-control @error('currentPassword') is-invalid @enderror" id="currentPassword">
                        @error('currentPassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Nueva Contraseña</label>
                        <input type="password" name="newPassword" autofocus class="form-control @error('newPassword') is-invalid @enderror" id="newPassword">
                        @error('newPassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="newPassword_confirmation" class="form-label">Repetir Nueva Contraseña</label>
                        <input type="password" name="newPassword_confirmation" autofocus class="form-control" id="newPassword_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Grabar ✔</button>
                </form>
            </div>
			<div class="col-12 col-md-3"></div>
		</div>
	</div>
@endsection