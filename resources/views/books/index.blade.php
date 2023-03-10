@extends('layouts.dashBoard')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
    <div class="container mb-4">
        <h1>Libros</h1>
        <a href="{{route('mantenimiento-libros.create')}}" class="btn btn-primary mb-4">Nuevo Libro ✔</a>
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
        <table class="table table-striped" id="table-dataTable">
            <thead>
                <th>Id</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Pdf</th>
                <th>Categoría</th>
                <th>Estado</th>
                <th>Fecha Registro</th>
                <th>Editar</th>
                <th>Cambio</th>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{$book->id}}</td>
                        <td>{{$book->title}}</td>
                        <td>{{$book->description}}</td>
                        <td>S/ {{$book->price}}</td>
                        <td>S/ {{$book->discount}}</td>
                        <td>
                            <form method="POST" action="{{route('downloadPdf', $book->pdf)}}" id="delete-form-book">
                                @method('POST')
                                @csrf
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-download"></i></button>
                            </form>   
                        </td> 
                        <td>{{$book->category->name}}</td>
                        @if($book->state == 1) 
                            <td>Activado</td>
                        @else
                            <td>Desactivado</td>
                        @endif
                        <td>{{date("d/m/Y", strtotime($book->created_at))}}</td>
                        <td>
                            <a href="{{route('mantenimiento-libros.edit', $book->id)}}" class="btn btn-warning w-100">Editar</a> 
                        </td>
                        <td>
                            <form method="POST" action="{{route('changeStateBook', $book->id)}}" id="delete-form-book">
                                @method('POST')
                                @csrf
                                @if($book->state == 1) 
                                    <button type="submit" class="btn btn-danger w-100 btn-eliminar">Desactivar</button>
                                @else
                                    <button type="submit" class="btn btn-success w-100 btn-eliminar">Activar</button>
                                @endif
                            </form>   
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script src="/js/datatable.js"></script>
    <script>dataTable()</script>
@endsection
