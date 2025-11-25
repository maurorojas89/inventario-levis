@extends('layouts.app')

@section('title', 'Gestión de Compras')

@section('content')
<div class="container">
    <h1 class="mb-3">Módulo Compras</h1>

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
        <div class="card-header">Registrar Compra</div>
        <div class="card-body">
            <form method="POST" action="{{ route('compras.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Proveedor</label>
                        <select name="id_proveedor" id="id_proveedor" class="form-select" required>
                            <option value="">Selecciona proveedor</option>
                            @foreach($proveedores as $p)
                                <option value="{{ $p->id_proveedor }}" data-rol="{{ $p->rolProveedor }}">{{ $p->nombreProveedor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Rol del proveedor</label>
                        <input type="text" id="rolProveedor" class="form-control" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fecha de Compra</label>
                        <input type="date" name="fechaCompra" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Estado</label>
                        <select name="estadoCompra" class="form-select" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Recibida">Recibida</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
                    </div>
                </div>

                <hr>
                <h5>Productos comprados</h5>
                <div id="productos">
                    <div class="row g-2 mb-2 producto-item">
                        <div class="col-md-4">
                            <select name="productos[0][id_producto]" class="form-select" required>
                                @foreach($productos as $prod)
                                    <option value="{{ $prod->id_producto }}">{{ $prod->nombreProducto }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="productos[0][cantidad]" class="form-control" placeholder="Cantidad" required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" step="0.01" name="productos[0][precioUnitario]" class="form-control" placeholder="Precio" required>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary mb-3" onclick="agregarProducto()">+ Producto</button>

                <div class="text-end">
                    <button class="btn btn-success">Registrar Compra</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($compras as $c)
            <tr>
                <td>{{ $c->id_compra }}</td>
                <td>{{ $c->proveedor->nombreProveedor ?? '—' }}</td>
                <td>{{ $c->fechaCompra }}</td>
                <td>{{ $c->estadoCompra }}</td>
                <td>${{ number_format($c->totalCompra, 2) }}</td>
                <td>—</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay compras registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
document.getElementById('id_proveedor').addEventListener('change', function() {
    const rol = this.options[this.selectedIndex].getAttribute('data-rol');
    document.getElementById('rolProveedor').value = rol || '';
});

let index = 1;
function agregarProducto() {
    const container = document.getElementById('productos');
    const html = `
    <div class="row g-2 mb-2 producto-item">
        <div class="col-md-4">
            <select name="productos[${index}][id_producto]" class="form-select" required>
                @foreach($productos as $prod)
                    <option value="{{ $prod->id_producto }}">{{ $prod->nombreProducto }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="productos[${index}][cantidad]" class="form-control" placeholder="Cantidad" required>
        </div>
        <div class="col-md-2">
            <input type="number" step="0.01" name="productos[${index}][precioUnitario]" class="form-control" placeholder="Precio" required>
        </div>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
    index++;
}
</script>
@endsection
