@extends('layouts.navApp')

@section('content')
    <div class="container mt-5">
        @if(session('messageError'))
            <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                {{session('messageError')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="table-responsive">
            <h1 class="text-center mb-4">Carrito de Compras</h1>
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)   
                        <tr>
                            <td><img src="{{asset('images/books/'.$item->attributes->image)}}" alt="" width="100px" height="100px" style="object-fit: cover"></td>
                            <td>{{$item->name}}</td>
                            <td>S/ {{$item->price}}</td>
                            <td><input type="number" value="{{$item->quantity}}" class="form-control" min="1" id="{{$item->id}}"></td>
                            <td>S/ {{(($item->price) * ($item->quantity))}}</td>
                            <td>
                                <form action="{{route('updateProductToCart')}}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <input type="hidden" name="quantity" value="{{$item->quantity}}" id="{{'inputQuantity_'.$item->id}}">
                                    <button type="submit" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route('deleteProductToCart')}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container-btn d-flex justify-content-between">
                <a href="{{route('index')}}" class="btn border"><i class="fa-solid fa-circle-left me-2"></i> Seguir Comprando</a>
                <form action="{{route('processCart')}}" method="POST">
                    @method('POST')
                    @csrf
                    <button type="submit" class="btn btn-success"><i class="fa-regular fa-credit-card me-2"></i> Realizar Compra</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/cart/index.js"></script>
@endsection