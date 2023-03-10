<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Hola {{$user->name}} {{$user->surname}}</h2>

    <p>-------------------------------</p>
    <p>Fecha: {{$sale->created_at}}</p>
    <p>Total : S/ {{$sale->total}}</p>
    <p>-------------------------------</p>

    <h4>Detalle Compra</h4>
    <table border="1">
        <thead>
            <th>Libro</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{$book->name}}</td>
                    <td>S/ {{$book->price}}</td>
                    <td>{{$book->quantity}}</td>
                    <td>S/ {{($book->price * $book->quantity)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>