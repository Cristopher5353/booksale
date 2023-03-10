@extends('layouts.dashBoard')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
    <div class="container mb-4">
        <h1>Comentarios Libros</h1>
        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                {{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table table-striped" id="table-dataTable">
            <thead>
                <th>Id</th>
                <th>Puntaje</th>
                <th>Comentario</th>
                <th>Libro</th>
                <th>Estado</th>
                <th>Fecha Registro</th>
                <th>Cambio</th>
            </thead>
            <tbody>
                @foreach($bookComments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->stars}}</td>
                        <td>{{$comment->comment}}</td>
                        <td>{{$comment->book->title}}</td>
                        @if($comment->state == 1) 
                            <td>Publicado</td>
                        @else
                            <td>Desactivado</td>
                        @endif
                        <td>{{date("d/m/Y", strtotime($comment->created_at))}}</td>
                        <td>
                            <form method="POST" action="{{route('changeStateBookComment')}}" id="delete-form-publication">
                                @method('POST')
                                @csrf
                                <input type="hidden" name="id" value="{{$comment->id}}">
                                @if($comment->state == 1) 
                                    <button type="submit" class="btn btn-danger w-100 btn-eliminar">Desactivar</button>
                                @else
                                    <button type="submit" class="btn btn-success w-100 btn-eliminar">Publicar</button>
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