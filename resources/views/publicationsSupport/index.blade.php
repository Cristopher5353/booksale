@extends('layouts.dashBoard')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
    <div class="container pb-4">
        <h1>Publicaciones</h1>
        <a href="{{route('mantenimiento-publicaciones.create')}}" class="btn btn-primary mb-4">Nueva Publicación ✔</a>
        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                {{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table table-striped" id="table-dataTable">
            <thead>
                <th>Id</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Fecha Registro</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </thead>
            <tbody>
                @foreach($publications as $publication)
                    <tr>
                        <td>{{$publication->id}}</td>
                        <td>{{$publication->title}}</td>
                        <td>{{$publication->description}}</td>
                        <td><img src="{{asset('images/publications/'.$publication->image)}}" style="width:150px; height:80px; object-fit:cover" alt=""></td>
                        <td>{{date("d/m/Y", strtotime($publication->created_at))}}</td>
                        <td>
                            <a href="{{route('mantenimiento-publicaciones.edit', $publication->id)}}" class="btn btn-warning w-100">Editar</a> 
                        </td>
                        <td>
                            <form method="POST" action="{{route('mantenimiento-publicaciones.destroy', $publication->id)}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger w-100 btn-eliminar">Eliminar</button>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/datatable.js"></script>
    <script>dataTable()</script>
    <script src="/js/delete.js"></script>
@endsection