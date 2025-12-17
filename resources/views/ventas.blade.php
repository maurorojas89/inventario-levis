@extends('layouts.app')

@section('title', 'Gestión de Ventas')

@section('content')
<style>
    body {
        background-color: #1a1a1a;
        color: #fff;
    }
    h2 {
        color: #C70202;
        text-align: center;
        margin-bottom: 30px;
    }
    .card {
        background-color: #3d3f3fff;
        border: none;
        box-shadow: 0 0 15px rgba(0,0,0,0.5);
        margin-bottom: 20px;
    }
    .card-header {
        background-color: #C70202;
        color: #fff;
        font-weight: bold;
    }
    .form-label {
        color: #ddd;
    }
    .form-control, .form-select, textarea {
        background-color: #1a1a1a;
        color: #fff;
        border: 1px solid #991212ff;
    }
    .form-control:focus, .form-select:focus, textarea:focus {
        border-color: #C70202;
        box-shadow: none;
    }
    .btn-success {
        background-color: #C70202;
        border: none;
    }
    .btn-success:hover {
        background-color: #a00101;
    }
    .btn-secondary {
        background-color: #444;
        border: none;
        color: #fff;
    }
    .btn-secondary:hover {
        background-color: #666;
    }
    .btn-primary {
        background-color: #C70202;
        border: none;
    }
    .btn-primary:hover {
        background-color: #a00101;
    }
    .btn-danger {
        background-color: #ff4444;
        border: none;
    }
    .btn-danger:hover {
        background-color: #cc0000;
    }
    .btn-outline-danger {
        border-color: #ff4444;
        color: #ff4444;
    }
    .btn-outline-danger:hover {
        background-color: #ff4444;
        color: #fff;
    }
    .table {
        background-color: #474f4aff;
        color: #fff;
    }
    .table thead {
        background-color: #C70202;
        color: #fff;
    }
</style>

<div class="container">
    <h2>Gestión de Ventas</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin:0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulario de registro --}}
    <div class="card mb-4">
        <div class="card-header">Registrar Venta</div>
        <div class="card-body">
            <form id="ventaForm" method="POST" action="{{ route('ventas.store') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="id_cliente" class="form-label">Cliente</label>
                        <select name="id_cliente" id="id_cliente" class="form-select" required>
                            <option value="">Selecciona un cliente</option>
                            @foreach($clientes as $c)
                                <option value="{{ $c->id_cliente }}">{{ $c->nombreCliente }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="fechaVenta" class="form-label">Fecha de Venta</label>
                        <input type="date" name="fechaVenta" id="fechaVenta" class="form-control" required
                               value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="estadoVenta" class="form-label">Estado</label>
                        <select name="estadoVenta" id="estadoVenta" class="form-select" required>
                            <option value="Completada">Completada</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
                    </div>
                </div>

                <hr>

                <h5>Productos</h5>
                <div id="itemsContainer"></div>

                <button type="button" class="btn btn-secondary mt-2" id="addItemBtn">+ Agregar producto</button>

                <div class="mt-3 text-end">
                    <h5>Total: $ <span id="totalGeneral">0.00</span></h5>
                    <input type="hidden" name="totalVenta" id="totalInput" value="0">
                </div>

                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-success">Registrar Venta</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Listado de ventas --}}
    <div class="card">
        <div class="card-header">Listado de Ventas</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($ventas as $v)
                    <tr>
                        <td>{{ $v->id_venta }}</td>
                        <td>{{ $v->cliente->nombreCliente ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($v->fechaVenta)->format('d/m/Y') }}</td>
                        <td>{{ $v->estadoVenta }}</td>
                        <td>${{ number_format($v->totalVenta, 2) }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('ventas.show', $v->id_venta) }}" class="btn btn-sm btn-primary">Ver detalle</a>
                                <form action="{{ route('ventas.destroy', $v->id_venta) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta venta?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No hay ventas registradas.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Script dinámico de productos (mantén tu código JS original) --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const productos = @json($productos);
    const itemsContainer = document.getElementById('itemsContainer');
    const addItemBtn = document.getElementById('addItemBtn');
    const totalGeneralSpan = document.getElementById('totalGeneral');
    const totalInput = document.getElementById('totalInput');
    const ventaForm = document.getElementById('ventaForm');

    function formatMoney(n) {
        return parseFloat(n).toFixed(2);
    }

    function recalcTotal() {
        let total = 0;
        itemsContainer.querySelectorAll('.item-row').forEach(row => {
            const subtotal = parseFloat(row.querySelector('.subtotal').value || 0);
            total += subtotal;
        });
        totalGeneralSpan.textContent = formatMoney(total);
        totalInput.value = formatMoney(total);
    }

    function createItemRow() {
        const index = itemsContainer.querySelectorAll('.item-row').length;
        const row = document.createElement('div');
        row.className = 'row g-2 align-items-end item-row mb-2';

        row.innerHTML = `
            <div class="col-md-4">
                <label class="form-label">Producto</label>
                <select name="items[${index}][id_producto]" class="form-select productoSelect" required>
                    <option value="">Selecciona producto</option>
                    ${productos.map(p => `<option value="${p.id_producto}" data-precio="${p.precioProducto}">${p.nombreProducto}</option>`).join('')}
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Precio unidad</label>
                <input type="number" class="form-control precioUnitario" name="items[${index}][precioUnitario]" step="0.01" min="0" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Cantidad</label>
                <input type="number" class="form-control cantidad" name="items[${index}][cantidad]" min="1" value="1" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Subtotal</label>
                <input type="number" class="form-control subtotal" name="items[${index}][subtotal]" step="0.01" min="0" readonly>
            </div>
            <div class="col-md-2 text-end">
                <button type="button" class="btn btn-outline-danger removeItemBtn">Eliminar</button>
            </div>
        `;

        const productoSelect = row.querySelector('.productoSelect');
        const precioUnitarioInput = row.querySelector('.precioUnitario');
        const cantidadInput = row.querySelector('.cantidad');
        const subtotalInput = row.querySelector('.subtotal');

        function updateRow() {
            const selected = productoSelect.options[productoSelect.selectedIndex];
            const precio = parseFloat(selected?.getAttribute('data-precio') || 0);
            const cantidad = parseInt(cantidadInput.value || 0);
            precioUnitarioInput.value = formatMoney(precio);
            subtotalInput.value = formatMoney(precio * cantidad);
            recalcTotal();
        }

        productoSelect.addEventListener('change', updateRow);
        cantidadInput.addEventListener('input', updateRow);
        row.querySelector('.removeItemBtn').addEventListener('click', () => {
            row.remove();
            recalcTotal();
        });

        itemsContainer.appendChild(row);
        updateRow(); // inicializa valores
    }

    addItemBtn.addEventListener('click', createItemRow);
    createItemRow(); // fila inicial

    ventaForm.addEventListener('submit', function(e) {
        const filas = itemsContainer.querySelectorAll('.item-row');
        let filasValidas = 0;

        filas.forEach(row => {
            const producto = row.querySelector('.productoSelect').value;
            const cantidad = row.querySelector('.cantidad').value;
            if (!producto || !cantidad || cantidad <= 0) {
                row.remove();
            } else {
                filasValidas++;
            
            }
        });

        if (filasValidas === 0) {
            e.preventDefault();
            alert('Debes agregar al menos un producto con cantidad válida.');
        }
    });
});</script>
@endsection
