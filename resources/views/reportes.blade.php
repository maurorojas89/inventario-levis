@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
<style>
    body {
        background-color: #1a1a1a;
        color: #fff;
    }
    h1 {
        color: #C70202;
        text-align: center;
        margin-bottom: 30px;
    }
    .card {
        background-color: #2a2a2a;
        border: none;
        box-shadow: 0 0 15px rgba(0,0,0,0.5);
        margin-bottom: 20px;
    }
    .card-header {
        background-color: #C70202;
        color: #fff;
        font-weight: bold;
    }
    .card-body {
        color: #ddd;
    }
    .table {
        background-color: #2a2a2a;
        color: #fff;
    }
    .table thead {
        background-color: #C70202;
        color: #fff;
    }
    .btn-outline-primary {
        border-color: #C70202;
        color: #C70202;
    }
    .btn-outline-primary:hover {
        background-color: #C70202;
        color: #fff;
    }
    .btn-outline-danger {
        border-color: #ff4444;
        color: #ff4444;
    }
    .btn-outline-danger:hover {
        background-color: #ff4444;
        color: #fff;
    }
</style>

<div class="container">
    <h1>Panel de Reportes</h1>

    {{-- Totales simples --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">Clientes</div>
                <div class="card-body">
                    <p class="h4">{{ $totalClientes }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">Proveedores</div>
                <div class="card-body">
                    <p class="h4">{{ $totalProveedores }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">Productos</div>
                <div class="card-body">
                    <p class="h4">{{ $totalProductos }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Totales financieros --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">Total Compras</div>
                <div class="card-body">
                    <p class="h4">${{ number_format($totalCompras, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">Total Ventas</div>
                <div class="card-body">
                    <p class="h4">${{ number_format($totalVentas, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">Balance</div>
                <div class="card-body">
                    <p class="h4">${{ number_format($balance, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Compras mensuales --}}
    <div class="card mb-4">
        <div class="card-header">Compras Mensuales</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
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
        </div>
    </div>

    {{-- Ventas mensuales --}}
    <div class="card mb-4">
        <div class="card-header">Ventas Mensuales</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
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
        </div>
    </div>
</div>
@endsection
