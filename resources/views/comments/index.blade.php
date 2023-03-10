@extends('layouts.navApp')

@section('css')
    <link rel="stylesheet" href="/css/comments/index.css">
@endsection

@section('content')
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
            {{session('message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container-comment mt-5">
        <div class="text-center comment-item">
            <img src="{{asset('images/books/'.$book->image)}}" alt="image-book" width="400" height="400" style="object-fit: contain">
            <h5 class="mt-3">Libro : {{$book->title}}</h5>
            <p>Descripción : {{$book->description}}</p>
            <p>Precio : S/ {{$book->price}}</p>
            @guest
                <a href="{{route('login')}}" class="btn btn-primary pe-4 ps-4"><i class="fa-solid fa-cart-plus"></i> Añadir al Carrito</a>
            @endguest
            @auth
                <form action="{{route('addProductToCart')}}" method="POST">
                    @method('POST')
                    @csrf
                    <input type="hidden" name="id" value="{{$bookId}}">
                    <button type="submit" class="btn btn-primary pe-4 ps-4"><i class="fa-solid fa-cart-plus"></i> Añadir al Carrito</button>
                </form>
            @endauth
        </div>
        <div class="p-4 comment-item">
            <h4>Déjanos tu comentario</h4>
            <form action="{{route('bookComment', $bookId)}}" method="POST">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="comment" class="form-label">Comentario :</label>
                    <input id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" placeholder="Ingresa tu comentario">
                    @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="stars" class="@error('stars') is-invalid @enderror">Puntaje: </label> <br>
                    @error('stars')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="stars" value="1">
                        <label class="form-check-label" for="inlineRadio1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="stars" value="2">
                        <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="stars" value="3">
                        <label class="form-check-label" for="inlineRadio2">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="stars" value="4">
                        <label class="form-check-label" for="inlineRadio2">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="stars" value="5">
                        <label class="form-check-label" for="inlineRadio2">5</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Enviar 📘</button>
              </form>
        </div>
    </div>
    <h2 class="ms-4 mt-4">Comentarios 📚✔</h2>
    <div class="mb-4">
        @if($bookComments->count() == 0) 
            <p class="ms-4">No hay comentarios para este libro</p>
        @else
            @foreach ($bookComments as $comment)
                <div class="d-flex justify-content-between border ms-4 me-4 p-2 mb-2 bg-secondary text-light" style="border-radius: 8px">
                    <p class="ms-4 me-4">📘 {{$comment->comment}}</p>
                    <p class="ms-4 me-4">📅 {{date("d/m/Y", strtotime($comment->created_at))}}</p>            
                </div>
            @endforeach
        @endif
    </div>
@endsection