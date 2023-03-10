@extends('layouts.dashBoard')

@section('content')
    <h1 class="mb-4 text-center">Agregar Libro</h1>
    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-2 col-lg-2"></div>
            <div class="col-12 col-md-8 col-lg-8">
                <form action="{{route('mantenimiento-libros.store')}}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="title" class="form-label">Título:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="description" class="form-label">Descripción:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="7" name="description">{{old('description')}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-lg-3">
                            <label for="price" class="form-label">Precio:</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price')}}">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-3">
                            <label for="discount" class="form-label">Descuento:</label>
                            <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{(old('discount')) ?old('discount') :0}}" min="0">
                            @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="pdf" class="form-label">Pdf:</label>
                            <input type="file" name="pdf" class="form-control @error('pdf') is-invalid @enderror" id="pdf" accept=".pdf" name="pdf">
                            @error('pdf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-lg-6">
                            <label for="category" class="form-label">Categoría:</label>
                            <select class="form-select @error('category') is-invalid @enderror" aria-label="Default select example" id="category" name="category">
                                <option selected disabled>Selecciona una opción...</option>
                                @foreach ($categories as $category)
                                    @if(old('category') == $category->id)
                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-3">
                            <label for="state" class="form-label">Estado:</label>
                            <input type="text" class="form-control" id="state" value="Activado" disabled>
                        </div>
                        <div class="col-12 col-lg-3">
                            <label for="created_at" class="form-label">Fecha Registro:</label>
                            <input type="text" class="form-control" id="created_at" value="{{date('d/m/Y')}}" disabled>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="photos" class="form-label">Imagenes:</label>
                            <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" accept=".png,.jpg,.jpge" id="photos" multiple>
                            @error('photos.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @if(session('messageError'))
                            <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                                {{session('messageError')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="row mt-3">
                        <input type="submit" value="Grabar ✔" class="btn btn-primary col-2 ml-3">
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-2 col-lg-2"></div>
        </div>
    </div>
@endsection
