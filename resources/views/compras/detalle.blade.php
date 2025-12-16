@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle de Compra</h2>
    <p>Proveedor: {{ $compra->proveedor->nombre }}</p>
    <p>Fecha: {{ $compra->fecha }}</p>
    <p>Estado: {{ $compra->estado }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compra->detalles as $d)
            <tr>
                <td>{{ $d->producto->nombreProducto }}</td>
                <td>{{ $d->cantidad }}</td>
                <td>{{ $d->precio_unitario }}</td>
                <td>{{ $d->subtotal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p>Total: {{ $compra->total }}</p>
</div>
@endsection
