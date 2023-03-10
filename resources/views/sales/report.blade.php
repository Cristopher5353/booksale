@extends('layouts.dashBoard')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
<div class="container mb-4">
    <h1>Ventas</h1>
    <form action="{{route('saleReport')}}" method="POST" class="mb-4">
        @csrf
        @method('POST')
        <div class="d-flex mb-3">
            <div class="mr-2">
                <label for="startDate">Fecha Inicio</label>
                <input type="date" class="form-control" name="startDate" id="startDate" value="{{$sDate != NULL ?$sDate :''}}">
            </div>
            <div>
                <label for="endDate">Fecha Fin</label>
                <input type="date" class="form-control" name="endDate" id="endDate" value="{{$eDate != NULL ?$eDate :''}}">
            </div>
        </div>
        <button onclick="reset()" class="btn btn-primary">Limpiar 📮</button>
        <button type="submit" name="pdf" value="false" class="btn btn-primary">Filtrar ✔</button>
        <button type="submit" name="pdf" value="true" class="btn btn-primary">Generar Reporte 📚</button>
    </form>
    <table class="table table-striped" id="table-dataTable">
        <thead>
            <th>Id</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Fecha Registro</th>
            <th>Detalle</th>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{$sale->id}}</td>
                    <td>{{$sale->user}}</td>
                    <td>S/ {{$sale->total}}</td>
                    <td>{{date("d/m/Y", strtotime($sale->fecha))}}</td>
                    <td><a href="{{route('saleDetailReport', $sale->id)}}" class="btn btn-primary">Reporte 🔎</a></td>
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
    <script src="/js/sales/report.js"></script>
    <script>dataTable(true, true, false)</script>
@endsection