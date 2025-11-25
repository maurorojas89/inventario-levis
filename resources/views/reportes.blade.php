@extends('layouts.app')
@section('title', 'Módulo Reportes')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="h5 m-0">Módulo Reportes</h2>
</div>

<div class="row g-3">
  <div class="col-md-3">
    <div class="card text-center">
      <div class="card-body">
        <h6 class="card-title">Clientes</h6>
        <p class="h4">{{ $totalClientes }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-center">
      <div class="card-body">
        <h6 class="card-title">Proveedores</h6>
        <p class="h4">{{ $totalProveedores }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-center">
      <div class="card-body">
        <h6 class="card-title">Productos</h6>
        <p class="h4">{{ $totalProductos }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-center">
      <div class="card-body">
        <h6 class="card-title">Balance</h6>
        <p class="h4">${{ number_format($balance, 0, ',', '.') }}</p>
      </div>
    </div>
  </div>
</div>

<hr>

<h5 class="mt-4">Totales</h5>
<ul>
  <li>Total Compras: ${{ number_format($totalCompras, 0, ',', '.') }}</li>
  <li>Total Ventas: ${{ number_format($totalVentas, 0, ',', '.') }}</li>
</ul>

<hr>

<h5 class="mt-4">Compras por mes</h5>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Mes</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach($comprasMensuales as $c)
      <tr>
        <td>{{ $c->mes }}</td>
        <td>${{ number_format($c->total, 0, ',', '.') }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

<h5 class="mt-4">Ventas por mes</h5>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Mes</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach($ventasMensuales as $v)
      <tr>
        <td>{{ $v->mes }}</td>
        <td>${{ number_format($v->total, 0, ',', '.') }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
