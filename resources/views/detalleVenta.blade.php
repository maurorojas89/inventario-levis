@extends('layouts.app')

@section('title', 'Detalle de Venta')

@section('content')
<div class="container">
    <h1 class="mb-3">Detalle de Venta #{{ $venta->id_venta }}</h1>
    <p class="mb-4">
        <strong>Cliente:</strong> {{ $venta->cliente->nombreCliente }} {{ $venta->cliente->apellidoCliente }}<br>
        <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($venta->fechaVenta)->format('Y-m-d') }}<br>
        <strong>Estado:</strong> {{ ucfirst($venta->estadoVenta) }}
    </p>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
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
            <form action="{{ route('detalleVenta.store', $venta->id_venta) }}" method="POST">
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
                        <label class="form-label">Precio unitario</label>
                        <input type="number" name="precioUnitario" class="form-control" step="0.01" min="0" required>
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
                <th>Precio unitario</th>
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
                <td>{{ number_format($d->precioUnitario, 2) }}</td>
                <td>{{ number_format($d->subtotal, 2) }}</td>
                <td>
                    <form action="{{ route('detalleVenta.destroy', [$venta->id_venta, $d->id_detalle]) }}" method="POST" onsubmit="return confirm('¿Eliminar este detalle?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay productos en esta venta.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver a ventas</a>
</div>
@endsection
