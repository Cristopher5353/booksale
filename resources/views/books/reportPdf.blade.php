<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Reporte Libros</title>
    <style>table {font-size: 12px;}</style>
</head>
<body>
    <h2 class="text-center">Libros BookSale</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
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
</body>
</html>