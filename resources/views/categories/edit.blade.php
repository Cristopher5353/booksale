@extends('layouts.dashBoard')

@section('content')
    <h1 class="mb-4 text-center">Editar Categoría</h1>
    <div class="container pb-5">
		<div class="row justify-content-center">
			<div class="col-12 col-md-3"></div>
			<div class="col-12 col-md-5">
                <form action="{{route('mantenimiento-categorias.update', $category->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Nombre</label>
                        <input type="text" name="name" autofocus class="form-control @error('name') is-invalid @enderror" id="name" value="{{$category->name}}">
                        @error('name')
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