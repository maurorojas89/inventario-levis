@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tareas Internas del Sistema</h2>

    <h4>Productos sin proveedor asignado</h4>
    <ul>
        @forelse($productosSinProveedor as $producto)
            <li>{{ $producto->nombreProducto ?? 'Sin nombre' }} (ID: {{ $producto->id_producto }})</li>
        @empty
            <li>No hay productos sin proveedor.</li>
        @endforelse
    </ul>

    <h4>Pedidos sin cliente asignado</h4>
    <ul>
        @forelse($pedidosSinCliente as $pedido)
            <li>Pedido ID: {{ $pedido->id_pedido ?? 'Sin ID' }}</li>
        @empty
            <li>No hay pedidos sin cliente.</li>
        @endforelse
    </ul>
</div>
@endsection
