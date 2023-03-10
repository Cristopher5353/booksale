<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Reporte Ventas</title>
    <style>table {font-size: 12px;}</style>
</head>
<body>
    <h2 class="text-center">Ventas BookSale</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <th>Id</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Fecha Registro</th>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{$sale->id}}</td>
                    <td>{{$sale->user}}</td>
                    <td>S/ {{$sale->total}}</td>
                    <td>{{date("d/m/Y", strtotime($sale->fecha))}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>