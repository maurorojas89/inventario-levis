@extends('layouts.app')

@section('title', 'Detalle de Compra')

@section('content')
<style>
    body {
        background-color: #1a1a1a;
        color: #fff;
    }
    h2 {
        color: #C70202;
        margin-bottom: 20px;
        text-align: center;
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
    .table {
        background-color: #2a2a2a;
        color: #C70202; /* números y texto en rojo */
    }
    .table thead {
        background-color: #C70202;
        color: #fff;
    }
</style>

<div class="container">
    <h2>Detalle de la Compra #{{ $compra->id_compra }}</h2>

    {{-- Información de la compra --}}
    <div class="card">
        <div class="card-header">Información general</div>
        <div class="card-body">
            <p><strong>Proveedor:</strong> {{ $compra->proveedor->nombreProveedor ?? 'Sin proveedor' }} ({{ $compra->proveedor->rolProveedor ?? '' }})</p>
            <p><strong>Fecha:</strong> {{ $compra->fecha }}</p>
            <p><strong>Estado:</strong> {{ $compra->estado }}</p>
            <p><strong>Total:</strong> ${{ number_format($compra->total, 2) }}</p>
        </div>
    </div>

    {{-- Productos de la compra --}}
    <div class="card">
        <div class="card-header">Productos</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($compra->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->nombreProducto }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay productos registrados en esta compra.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
