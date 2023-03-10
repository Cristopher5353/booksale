@extends('layouts.dashBoard')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
    <div class="container mb-4">
        <h1>Tiendas Físicas</h1>
        <a href="{{route('mantenimiento-tiendas.create')}}" class="btn btn-primary mb-4">Nueva Tienda ✔</a>
        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                {{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table table-striped" id="table-dataTable">
            <thead>
                <th>Id</th>
                <th>Dirección</th>
                <th>Departamento</th>
                <th>Provincia</th>
                <th>Distrito</th>
                <th>Imagen</th>
                <th>Fecha Registro</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </thead>
            <tbody>
                @foreach($stores as $store)
                    <tr>
                        <td>{{$store->id}}</td>
                        <td>{{$store->direction}}</td>
                        <td>{{$store->district->province->departament->name}}</td>
                        <td>{{$store->district->province->name}}</td>
                        <td>{{$store->district->name}}</td>
                        <td><img src="{{asset('images/stores/'.$store->image)}}" style="width:150px; height:70px; object-fit:cover" alt=""></td>
                        <td>{{date("d/m/Y", strtotime($store->created_at))}}</td>
                        <td>
                            <a href="{{route('mantenimiento-tiendas.edit', $store->id)}}" class="btn btn-warning w-100">Editar</a> 
                        </td>
                        <td>
                            <form method="POST" action="{{route('mantenimiento-tiendas.destroy', $store->id)}}">
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