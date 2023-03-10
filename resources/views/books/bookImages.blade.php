@extends('layouts.dashBoard')

@section('css')
    <link rel="stylesheet" href="/css/books/bookImages.css">
@endsection

@section('content')
    <div class="container">
        <h1>Imágenes</h1>
        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                {{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('messageError'))
            <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                {{session('messageError')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container-images">
            <div class="row d-flex">
            @if(count($images) == 0)
                <p>No se han insertado imágenes</p>
            @else
                <div id="bookImages" class="row">
                    @foreach($images as $image)
                        <div class="col-6 col-sm-4 col-xl-2 mb-2 box-image" data-id="{{$image->id}}">
                            <div class="item-image">
                                <form method="POST" action="{{route('deleteBookImageById', [$book->id, $image->id])}}">
                                    @method('DELETE')
                                    @csrf
                                    <i class="fa-solid fa-circle-xmark icon-book-delete btn-eliminar"></i>
                                </form>   
                                <img src="{{asset('images/books/'.$image->image)}}" alt="img-book" class="img-book">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            </div>
        </div>
        <div>
            <form action="{{route('updateBookImages', $book->id)}}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
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
                </div>
                <div class="row mt-3">
                    <input type="submit" value="Grabar ✔" class="btn btn-primary col-2 ml-3">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="/js/books/bookImages.js"></script>
    <script src="/js/delete.js"></script>
@endsection