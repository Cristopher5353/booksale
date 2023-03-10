<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Reporte Detalle Venta</title>
    <style>table {font-size: 12px;}</style>
</head>
<body>
    <div class="text-center">
        <h2 class="mb-4">Detalle de Venta - BookSale</h2>
        <p>Fecha : {{date("d/m/Y", strtotime($sale->fecha))}}</p>
    </div>
    <p>Señor(es) : {{$sale->user}}</p>
    <p>Dni : {{$sale->dni}}</p>
    <p>Teléfono : {{$sale->phone}}</p>
    <table class="table table-striped">
        <thead class="thead-dark">
            <th>Cantidades</th>
            <th>Descripción</th>
            <th>Precio Unitario</th>
            <th>Valor de Venta</th>
        </thead>
        <tbody>
            @foreach($saleDetail as $detail)
                <tr>
                    <td>{{$detail->quantity}}</td>
                    <td>{{$detail->title}}</td>
                    <td>S/ {{$detail->price}}</td>
                    <td>S/ {{$detail->subtotal}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p class="text-right">Total : S/ {{$sale->total}}</p>
</body>
</html>