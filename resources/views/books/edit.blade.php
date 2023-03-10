@extends('layouts.dashBoard')

@section('content')
    <h1 class="mb-4 text-center">Agregar Libro</h1>
    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-2 col-lg-2"></div>
            <div class="col-12 col-md-8 col-lg-8">
                <form action="{{route('mantenimiento-libros.update', $book->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="title" class="form-label">Título:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{$book->title}}">
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
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="7" name="description">{{$book->description}}</textarea>
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
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{$book->price}}">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-3">
                            <label for="discount" class="form-label">Descuento:</label>
                            <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{($book->discount) ?$book->discount :0}}">
                            @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="pdf" class="form-label">Pdf:</label>
                            <input type="file" name="pdf" class="form-control @error('pdf') is-invalid @enderror mb-2" id="pdf" accept=".pdf" name="pdf">
                            <span">Actual:</span>
                            <span><a href="{{asset('documents/books/' . $book->pdf)}}" target="_blank">{{$book->pdf}}</a></span>
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
                                    @if($book->category_id == $category->id)
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
                            <a href="{{route('getBookImagesById', $book->id)}}" class="btn btn-secondary ml-2">Actualizar Imágenes 🔎</a>
                        </div>
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
