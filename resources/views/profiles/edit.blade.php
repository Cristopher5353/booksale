@extends(($user->role_id == 1) ?'layouts.dashBoard' :'layouts.navApp')

@section('css')
    <link rel="stylesheet" href="/css/profiles/edit.css">
@endsection

@section('content')
    <div class="container">
        @if($user->role_id == 1)
            <h1 class="text-center title-profile-dashboard">Perfil</h1>
        @else
            <h1 class="text-center title-profile-user">Perfil</h1>
        @endif
        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                {{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="banner-profile"></div>
        <div class="container-image-profile">
            @if($user->image == null)
                <img src="{{asset('images/default/img-profile-user-default.jpeg')}}" class="image-profile" alt="0">
            @else
                <img src="{{asset('images/users/'.$user->image)}}" class="image-profile" alt="1">
            @endif
            <div><i class="fa-solid fa-pen-to-square icon-edit-profile"></i></div>
        </div>
        <div>
            <h4 class="mb-3 information-title-profile">Información Personal</h4>
            <form action="{{route('updateProfile', $user->id)}}" method="POST" id="form-edit-profile">
                @method('PUT')
                @csrf
                <div class="c1 row">
                    <div class="mb-3 col-12 col-md-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$user->name}}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-3">
                        <label for="surname" class="form-label">Apellido</label>
                        <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" id="surname" value="{{$user->surname}}">
                        @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-3">
                        <label for="dni" class="form-label">Dni</label>
                        <input type="number" name="dni" class="form-control @error('dni') is-invalid @enderror" id="dni" value="{{$user->dni}}">
                        @error('dni')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{$user->phone}}">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="c2 row">
                    <div class="mb-3 col-12 col-lg-6">
                      <label for="email" class="form-label">Correo</label>
                      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$user->email}}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-lg-3">
                        <label for="rol" class="form-label">Rol</label>
                        <input type="text" class="form-control" id="rol" value="{{$user->role->name}}" disabled>
                    </div>
                    <div class="mb-3 col-12 col-lg-3">
                        <label for="state" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="state" value="{{($user->state == 1) ?'Activado' :'Desactivado'}}" disabled>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Editar Perfil ✔</button>
                @if($user->role_id != 1)
                    <br>
                    <a href="{{route('editPassword', $user->id)}}" class="mt-2 d-block">Cambiar Contraseña</a>
                @endif
            </form>
        </div>
    </div>

    <form action="{{route('updateImageProfile', $user->id)}}" method="POST" enctype="multipart/form-data" id="formUpdloadImage" style="visibility: hidden">
        @method("POST")
        @csrf
        <input type="file" name="photo" accept=".png, .jpg, .jpeg" id="inputUploadImage">
        <button type="submit" id="btn-update-photo-profile"></button>
    </form>

    <form action="{{route('deleteImageProfile', $user->id)}}" method="POST" enctype="multipart/form-data" id="formDeleteImage" style="visibility: hidden">
        @method("DELETE")
        @csrf
        <button type="submit" id="btn-delete-photo-profile"></button>
    </form>

    <button type="button" class="btn btn-primary btn-open-modal-update-photo" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="visibility: hidden;"></button>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Actualizar foto</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row justify-content-center">
              <button class="btn btn-danger col-12 col-md-5 btn-delete-photo">Eliminar Foto</button>
              <button class="btn bg-primary col-12 col-md-5 btn-update-photo">Actualizar Foto</button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const deleteImageProfile = () => {
            document.getElementById("btn-delete-photo-profile").click();
        }

        const updateImageProfile = () => {
            let formUpdloadImage = document.getElementById("formUpdloadImage");
            formUpdloadImage.photo.click();
        }

        const openUpdateImage = () => {
            let imageProfile = document.querySelector(".image-profile").getAttribute("alt");
            if(imageProfile == "1") {
                document.querySelector(".btn-open-modal-update-photo").click();
            } else {
                updateImageProfile();
            }
        }

        document.addEventListener("DOMContentLoaded", (e) => {
            document.addEventListener("click", (e) => {
                if(e.target.matches(".icon-edit-profile")) {
                    openUpdateImage();
            
                } else if(e.target.matches(".btn-delete-photo")) {
                    deleteImageProfile();
            
                } else if(e.target.matches(".btn-update-photo")) {
                    updateImageProfile();
                }
            })
            
            document.addEventListener("change", (e) => {
                if (e.target.matches("#inputUploadImage")) {
                    if (e.isTrusted) {
                        document.getElementById("btn-update-photo-profile").click();
                    }
                }
            })
        })
    </script>
@endsection