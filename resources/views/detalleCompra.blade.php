@extends('layouts.app')

@section('title', 'Detalle de Compra')

@section('content')
<div class="container">
    <h1 class="mb-3">Detalle de Compra #{{ $compra->id_compra }}</h1>
    <p class="mb-4">
        <strong>Proveedor:</strong> {{ $compra->proveedor->nombreProveedor ?? '—' }}<br>
        <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($compra->fechaCompra)->format('Y-m-d') }}<br>
        <strong>Estado:</strong> {{ ucfirst($compra->estadoCompra) }}<br>
        <strong>Total:</strong> ${{ number_format($compra->totalCompra, 2) }}
    </p>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <strong>Errores:</strong>
        <ul class="mb-0">
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">Agregar producto</div>
        <div class="card-body">
            <form action="{{ route('detalleCompra.store', $compra->id_compra) }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label">Producto</label>
                        <select name="id_producto" class="form-select" required>
                            <option value="">Selecciona un producto</option>
                            @foreach($productos as $p)
                                <option value="{{ $p->id_producto }}">{{ $p->nombreProducto }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" min="1" value="1" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Costo unitario</label>
                        <input type="number" name="costoUnitario" class="form-control" step="0.01" min="0" required>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button class="btn btn-success w-100" type="submit">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Costo unitario</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detalles as $d)
            <tr>
                <td>{{ $d->id_detalle }}</td>
                <td>{{ $d->producto->nombreProducto ?? '—' }}</td>
                <td>{{ $d->cantidad }}</td>
                <td>{{ number_format($d->costoUnitario, 2) }}</td>
                <td>{{ number_format($d->subtotal, 2) }}</td>
                <td>
                    <form action="{{ route('detalleCompra.destroy', [$compra->id_compra, $d->id_detalle]) }}" method="POST" onsubmit="return confirm('¿Eliminar este detalle?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay productos en esta compra.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('compras.index') }}" class="btn btn-secondary">Volver a compras</a>
</div>
@endsection
