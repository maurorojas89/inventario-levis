@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle de Venta #{{ $venta->id_venta }}</h2>

    <div class="card mb-4">
        <div class="card-header">Información general</div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4">
                    <p><strong>Cliente:</strong> {{ $venta->cliente->nombreCliente ?? '—' }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($venta->fechaVenta)->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Estado:</strong> {{ $venta->estadoVenta }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col text-end">
                    <h5>Total de la venta: ${{ number_format($venta->totalVenta, 2) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Productos vendidos</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Precio unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($venta->detalles as $i => $d)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $d->producto->nombreProducto ?? '—' }}</td>
                        <td>${{ number_format($d->precioUnitario, 2) }}</td>
                        <td>{{ $d->cantidad }}</td>
                        <td>${{ number_format($d->subtotal, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No hay productos registrados en esta venta.</td></tr>
                @endforelse
                </tbody>
            </table>
            <div class="text-end">
                <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver al listado</a>
            </div>
        </div>
    </div>
</div>
@endsection
