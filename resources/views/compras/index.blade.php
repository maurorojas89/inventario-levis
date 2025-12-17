@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="color:#C70202;">Listado de Compras</h2>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($compras as $compra)
                <tr>
                    <td>{{ $compra->id_compra }}</td>
                    <td>{{ $compra->proveedor->nombreProveedor ?? 'Sin proveedor' }} - {{ $compra->proveedor->rolProveedor ?? '' }}</td>
                    <td>{{ $compra->fecha }}</td>
                    <td>{{ $compra->estado }}</td>
                    <td>${{ number_format($compra->total, 2) }}</td>
<td><button class="btn btn-sm btn-secondary" disabled>Detalle</button></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay compras registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3 style="color:#C70202;">Registrar nueva compra</h3>
    @include('compras.form')
</div>
@endsection
