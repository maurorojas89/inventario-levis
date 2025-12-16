@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Compras</h2>

    {{-- LISTADO --}}
    <table class="table table-bordered mb-5">
        <thead>
            <tr>
                <th>ID Compra</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($compras as $compra)
            <tr>
                <td>{{ $compra->id_compra }}</td>
                <td>
                    {{ $compra->proveedor->nombreProveedor ?? 'Sin proveedor' }}
                    - {{ $compra->proveedor->rolProveedor ?? '' }}
                </td>
                <td>{{ $compra->fecha }}</td>
                <td>{{ $compra->estado }}</td>
                <td>{{ number_format($compra->total, 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No hay compras registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- FORMULARIO DE NUEVA COMPRA --}}
    <h2 class="mb-4">Registrar nueva compra</h2>
    <form action="{{ route('compras.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_proveedor" class="form-label">Proveedor</label>
            <select name="id_proveedor" id="id_proveedor" class="form-select" required>
                <option value="">Seleccione un proveedor</option>
                @foreach($proveedores as $prov)
                    <option value="{{ $prov->id_proveedor }}" data-rol="{{ $prov->rolProveedor }}">
                        {{ $prov->nombreProveedor }} - {{ $prov->rolProveedor }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select">
                <option value="Pendiente">Pendiente</option>
                <option value="Pagada">Pagada</option>
            </select>
        </div>

        {{-- PRODUCTOS EXISTENTES --}}
        <h4>Agregar productos existentes</h4>
        <table class="table" id="productosTable">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="productos[0][id_producto]" class="form-select producto-select">
                            @foreach($productos as $prod)
                                <option value="{{ $prod->id_producto }}" data-proveedor="{{ $prod->id_proveedor }}">
                                    {{ $prod->nombreProducto }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="productos[0][cantidad]" class="form-control cantidad" min="1" value="1"></td>
                    <td><input type="number" name="productos[0][precio_unitario]" class="form-control precio" step="0.01"></td>
                    <td><input type="text" class="form-control subtotal" readonly></td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow">Eliminar</button></td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-secondary mb-3" id="addRow">Agregar producto existente</button>

        {{-- NUEVO PRODUCTO --}}
        <h4>Agregar nuevo producto</h4>
        <div class="mb-3">
            <label for="nuevo_nombre" class="form-label">Nombre del producto</label>
            <input type="text" name="nuevo_nombre" id="nuevo_nombre" class="form-control">
        </div>
        <div class="mb-3">
            <label for="nuevo_descripcion" class="form-label">Descripción</label>
            <input type="text" name="nuevo_descripcion" id="nuevo_descripcion" class="form-control">
        </div>
        <div class="mb-3">
            <label for="nuevo_precio" class="form-label">Precio unitario</label>
            <input type="number" name="nuevo_precio" id="nuevo_precio" class="form-control precio" step="0.01">
        </div>
        <div class="mb-3">
            <label for="nuevo_stock" class="form-label">Cantidad</label>
            <input type="number" name="nuevo_stock" id="nuevo_stock" class="form-control cantidad" min="1">
        </div>
        <div class="mb-3">
            <label for="nuevo_subtotal" class="form-label">Subtotal nuevo producto</label>
            <input type="text" id="nuevo_subtotal" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="text" name="total" id="total" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Registrar compra</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function calcularTotales() {
        let total = 0;

        // Productos existentes
        document.querySelectorAll('#productosTable tbody tr').forEach(function(row) {
            let cantidad = parseFloat(row.querySelector('.cantidad').value) || 0;
            let precio = parseFloat(row.querySelector('.precio').value) || 0;
            let subtotal = cantidad * precio;
            row.querySelector('.subtotal').value = subtotal.toFixed(2);
            total += subtotal;
        });

        // Producto nuevo
        let nuevoCantidad = parseFloat(document.getElementById('nuevo_stock')?.value) || 0;
        let nuevoPrecio = parseFloat(document.getElementById('nuevo_precio')?.value) || 0;
        let nuevoSubtotal = nuevoCantidad * nuevoPrecio;
        document.getElementById('nuevo_subtotal').value = nuevoSubtotal.toFixed(2);
        total += nuevoSubtotal;

        // Total general
        document.getElementById('total').value = total.toFixed(2);
    }

    // Recalcular en tiempo real
    document.addEventListener('input', calcularTotales);

    // Botón para agregar filas de productos existentes
    document.getElementById('addRow').addEventListener('click', function() {
        let tbody = document.querySelector('#productosTable tbody');
        let index = tbody.querySelectorAll('tr').length;

        let newRow = tbody.querySelector('tr').cloneNode(true);
        newRow.querySelectorAll('input, select').forEach(function(input) {
            input.name = input.name.replace(/\d+/, index);
            if(input.classList.contains('subtotal')) input.value = '';
            if(input.classList.contains('cantidad')) input.value = 1;
            if(input.classList.contains('precio')) input.value = '';
        });

        tbody.appendChild(newRow);
    });

    // Eliminar fila
    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('removeRow')) {
            e.target.closest('tr').remove();
            calcularTotales();
        }
    });

    // Filtrar productos según proveedor
    document.getElementById('id_proveedor').addEventListener('change', function() {
        let proveedorId = this.value;
        document.querySelectorAll('.producto-select option').forEach(function(opt) {
            opt.hidden = (opt.dataset.proveedor !== proveedorId);
        });
    });

    // Calcular al cargar
    calcularTotales();
});
</script>
@endpush
