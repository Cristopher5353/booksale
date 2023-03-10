@extends('layouts.DashBoard')

@section('content')
    <h1 class="mb-4 text-center">Editar Publicación</h1>
    <div class="container pb-5">
		<div class="row justify-content-center">
			<div class="col-12 col-md-3"></div>
			<div class="col-12 col-md-5">
                <form action="{{route('mantenimiento-publicaciones.update', $publication->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" name="title" autofocus class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $publication->title }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" cols="30" rows="10">{{ $publication->description }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <label for="photo" class="form-label">Imagen</label>
                    <div class="input-group mb-3">
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" id="photo" accept=".png, .jpg, .jpeg">
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Grabar ✔</button>
                </form>
            </div>
			<div class="col-12 col-md-3"></div>
		</div>
	</div>
@endsection