@extends('layouts.navApp')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
<link rel="stylesheet" href="/css/index.css">
@endsection

@section('content')
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
            {{session('message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="bg-primary p-3 text-white d-flex justify-content-evenly flex-wrap">
        <p>coronelcristopher553@gmail.com 💻🖥</p>
        <p>954854858 📱📲</p>
        <p>BookSale 📘📗</p>
    </div>
    <div id="carouselBannerInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item" data-bs-interval="3000">
                <p class="p">Un buen libro no termina, se enconde dentro de nosotros</p>
                <img src="{{asset('images/banners/banner-3.jpg')}}" class="d-block w-100 image-banner" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <p class="p">Libros, caminos y días dan al hombre sabiduría</p>
                <img src="{{asset('images/banners/banner-2.jpg')}}" class="d-block w-100 image-banner" alt="...">
            </div>
            <div class="carousel-item active" data-bs-interval="3000">
                <p class="p">Hay grandes libros en el mundo y grandes mundos en los libros</p>
                <img src="{{asset('images/banners/banner-1.jpg')}}" class="d-block w-100 image-banner" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselBannerInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselBannerInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container mt-5 mb-5">
        <div class="swiper mySwiperProducts">
            <div class="swiper-wrapper swiper-wrapper-products">
            @foreach ($books as $book)
                <div class="swiper-slide swiper-slide-product">
                    <div class="book-item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#showProduct">
                            <div class="show-book-item" id="{{$book->id}}">
                                <i class="fa-solid fa-eye show-icon-book-item"></i>
                            </div>
                        </a>
                        @php
                            $firstImage = explode(",", $book->images)[0];
                        @endphp
                        <div class="container-book-image">
                            @if($firstImage == null)
                                <img src="{{asset('images/default/image-not.png')}}" alt="no imagen" class="book-image">
                            @else
                                <img src="{{asset('images/books/'.$firstImage)}}" alt="imagen libro" class="book-image">
                            @endif
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between">
                                <span><strong class="book-subtitle">Nombre: </strong>{{$book->title}}</span>
                                @if($book->discount != 0.00)
                                    <span>S/ {{number_format(($book->price) - ($book->discount), 2)}}</span>
                                @else    
                                    <span>S/ {{$book->price}}</span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between">
                                <span><strong class="book-subtitle">Categoría: </strong>{{$book->category}}</span>
                                @if($book->discount != 0.00)
                                    <span class="text-decoration-line-through text-muted">S/ {{$book->price}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @guest
                        <a href="{{route('login')}}" class="btn btn-primary w-100 mt-4"><i class="fa-solid fa-cart-plus"></i> Añadir al Carrito</a>
                    @endguest
                    @auth
                        <form action="{{route('addProductToCart')}}" method="POST">
                            @method('POST')
                            @csrf
                            <input type="hidden" name="id" value="{{$book->id}}">
                            <button type="submit" class="btn btn-primary w-100 mt-4"><i class="fa-solid fa-cart-plus"></i> Añadir al Carrito</button>
                        </form>
                    @endauth
                    <a href="{{route('bookComments', $book->id)}}" class="btn btn-secondary w-100 mt-2"><i class="fa-solid fa-comments me-2"></i>Comentarios</a>
                </div>
            @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="container-information d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h2 class="text-white text-bold">Venta de Libros Online</h2>
            <span class="text-white">Es hora de obtener conocimiento</span><br>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <h2 class="text-center mb-4">Publicaciones</h2>
        <div class="swiper mySwiperElement">
            <div class="swiper-wrapper swiper-wrapper-elements">
            @foreach ($publications as $publication)
                <div class="swiper-slide swiper-slide-element">
                    <div class="element-item">
                        <div class="element-p-1">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#showPublication">
                                <span class="publication-date"><i class="fa-solid fa-calendar"></i> {{date('d/m/Y', strtotime($publication->created_at))}}</span>
                                <img src="{{asset('images/publications/'.$publication->image)}}" alt="" class="element-image" id="{{$publication->id}}">
                            </a>
                        </div>
                        <div class="text-center mt-3 element-p-2">
                            <h3>{{$publication->title}}</h3>
                            <p>{{substr($publication->description, 0, 60)}}...</p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="container-information d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h2 class="text-white text-bold">Los libros son el mejor viático que se ha encontrado para este humano viaje</h2>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <h2 class="text-center mb-4">Tiendas Presenciales</h2>
        <div class="swiper mySwiperElement">
            <div class="swiper-wrapper swiper-wrapper-elements">
            @foreach ($stores as $store)
                <div class="swiper-slide swiper-slide-element">
                    <div class="element-item">
                        <div class="element-p-1">
                            <a href="https://maps.google.com/?q={{$store->lat}},{{$store->long}}" target="_blank">
                                <img src="{{asset('images/stores/'.$store->image)}}" alt="" class="element-image">
                            </a>
                        </div>
                        <div class="text-center mt-3 element-p-2 pe-2 ps-2">
                            <h3>{{$store->direction}}</h3>
                            <p>{{$store->district->province->departament->name}}-{{$store->district->province->name}}-{{$store->district->name}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <footer class="bg-dark footer text-white text-center p-4">
        BookSale - Cristopher Coronel Zavaleta ✌📚
    </footer>
    <div class="modal fade" id="showPublication" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTitlePublication"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" alt="" id="modalImagePublication">
                <p id="modalDescriptionPublication"></p>
            </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="showProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Detalle Producto</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">   
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 mb-3" style="display: flex; justify-content: center; align-items: center">
                                    <img src="" alt="" id="modalFirstImageProduct" style="width: 350px; height: 350px; object-fit: contain">
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <img src="" alt="" class="col-4" style="height: 200px; object-fit: contain" id="modalSecondImageProduct">
                                        <img src="" alt="" class="col-4" style="height: 200px; object-fit: contain" id="modalThirdImageProduct">
                                        <img src="" alt="" class="col-4" style="height: 200px; object-fit: contain" id="modalFourthImageProduct">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h2 id="modalTitleProduct"></h2>
                            <a id="modalPriceOriginalProduct" class="text-decoration-line-through text-muted"></a>
                            <strong id="modalPriceWithDiscountProduct"></strong>
                            <p id="modalDescriptionProduct" class="mt-2"></p>
                            <div>
                                <div>
                                    <label for="">Cantidad</label>
                                    <input type="number" class="form-control" min="1" value="1" id="modalInputQuantityProduct">
                                </div>
                                <div>
                                @guest
                                    <a href="{{route('login')}}" class="btn btn-primary w-100 mt-4"><i class="fa-solid fa-cart-plus"></i> Añadir al Carrito</a>
                                @endguest
                                @auth
                                    <form action="{{route('addProductToCart')}}" method="POST">
                                        @method('POST')
                                        @csrf
                                        <input type="hidden" name="id" id="modalIdProduct">
                                        <input type="hidden" name="quantity" id="modalQuantityProduct">
                                        <button type="submit" class="btn btn-primary w-100 mt-4"><i class="fa-solid fa-cart-plus"></i> Añadir al Carrito</button>
                                    </form>
                                @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="/js/index.js"></script>
@endsection