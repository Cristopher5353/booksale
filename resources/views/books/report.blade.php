@extends('layouts.dashBoard')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
<div class="container mb-4">
    <h1>Libros</h1>
    <form action="{{route('bookReport')}}" method="POST" id="bookReportForm" class="mb-4">
        @csrf
        @method('POST')
        <select name="category_id" class="form-control" id="category_id">
            <option value="">Selecciona una opción...</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}" {{ $category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
            @endforeach
        </select>
        <button type="submit" name="pdf" value="false" class="btn btn-primary mt-2">Filtrar ✔</button>
        <button type="submit" name="pdf" value="true" class="btn btn-primary mt-2">Generar Reporte 📚</button>
    </form>
    <table class="table table-striped" id="table-dataTable">
        <thead>
            <th>Id</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Descuento</th>
            <th>Precio Original</th>
            <th>Categoría</th>
            <th>Fecha Registro</th>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{$book->id}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->description}}</td>
                    <td>S/ {{$book->price}}</td>
                    <td>S/ {{$book->discount}}</td>
                    <td>S/ {{($book->price_original)}}</td>
                    <td>{{$book->category}}</td>
                    <td>{{date("d/m/Y", strtotime($book->created_at))}}</td>
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
    <script src="/js/books/report.js"></script>
    <script>dataTable(false, false, false)</script>
@endsection