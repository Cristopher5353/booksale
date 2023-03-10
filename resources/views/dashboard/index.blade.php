@extends('layouts.dashBoard')

@section('css')
    <link rel="stylesheet" href="/css/dashboard/index.css">
@endsection

@section('content')
    <h1 class="ml-3">DashBoard</h1>
    <div class="mt-4 mb-4 container-information">
        <div class="p-5 bg-light text-center item-information">
            <h4>Total de Ventas</h4>
            <i class="fa-solid fa-hand-holding-dollar fs-1 text-primary"></i>
            <h2 class="mt-3">S/ {{$totalSales}}</h2>
        </div>
        <div class="p-5 bg-light text-center item-information">
            <h4>Últimas Ventas del día</h4>
            <i class="fa-sharp fa-solid fa-calendar-days fs-1 text-primary"></i>
            <h2 class="mt-3">S/ {{$totalSalesToday}}</h2>
        </div>
        <div class="p-5 bg-light text-center item-information">
            <h4>Cantidad de Clientes</h4>
            <i class="fa-solid fa-users fs-1 text-primary"></i>
            <h2 class="mt-3">{{$quantityCustomers}}</h2>
        </div>
    </div>
    <div class="container-charts pb-4">
        <div>
            <canvas id="chartFiveBestProducts" style="width:100%; max-width: 700px" class="bg-light item-information chart-item"></canvas>
        </div>
        <div>
            <canvas id="chartSalesPerMonth" style="width:100%; max-width: 700px" class="bg-light item-information chart-item"></canvas>
        </div>
        <div>
            <canvas id="chartFiveBestCustomers" style="width:100%; max-width: 700px" class="bg-light item-information chart-item"></canvas>
        </div>
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="/js/dashboard/index.js"></script>
@endsection