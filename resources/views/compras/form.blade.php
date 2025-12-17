<form action="{{ route('compras.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="id_proveedor" class="form-label">Proveedor</label>
        <select name="id_proveedor" id="id_proveedor" class="form-select" required>
            <option value="">Seleccione un proveedor</option>
            @foreach($proveedores as $prov)
                <option value="{{ $prov->id_proveedor }}" data-rol="{{ $prov->rolProveedor }}">
                    {{ $prov->nombreProveedor }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Rol del proveedor</label>
        <input type="text" id="rolProveedor" class="form-control" readonly>
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

    <h4 style="color:#C70202;">Productos</h4>
    <table class="table table-dark table-striped" id="productosTable">
        <thead>
            <tr>
                <th>Nombre producto</th>
                <th>Cantidad</th>
                <th>Costo Unitario</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="productos[0][nombre]" class="form-control" required></td>
                <td><input type="number" name="productos[0][cantidad]" class="form-control cantidad" min="1" required></td>
                <td><input type="number" name="productos[0][costoUnitario]" class="form-control costo" step="0.01" required></td>
                <td><input type="text" class="form-control subtotal" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
            </tr>
        </tbody>
    </table>
    <button type="button" id="addRow" class="btn btn-secondary">Agregar producto</button>

    <div class="mt-3">
        <label class="form-label">Total compra</label>
        <input type="text" id="totalCompra" class="form-control" readonly>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Registrar compra</button>
</form>

<script>
document.getElementById('id_proveedor').addEventListener('change', function() {
    var rol = this.options[this.selectedIndex].getAttribute('data-rol');
    document.getElementById('rolProveedor').value = rol ? rol : '';
});

let index = 1;
document.getElementById('addRow').addEventListener('click', function() {
    let table = document.getElementById('productosTable').getElementsByTagName('tbody')[0];
    let row = table.insertRow();
    row.innerHTML = `
        <td><input type="text" name="productos[${index}][nombre]" class="form-control" required></td>
        <td><input type="number" name="productos[${index}][cantidad]" class="form-control cantidad" min="1" required></td>
        <td><input type="number" name="productos[${index}][costoUnitario]" class="form-control costo" step="0.01" required></td>
        <td><input type="text" class="form-control subtotal" readonly></td>
        <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
    `;
    index++;
    attachEvents();
});

function attachEvents() {
    document.querySelectorAll('.cantidad, .costo').forEach(input => {
        input.addEventListener('input', updateTotals);
    });
    document.querySelectorAll('.removeRow').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('tr').remove();
            updateTotals();
        });
    });
}

function updateTotals() {
    let total = 0;
    document.querySelectorAll('#productosTable tbody tr').forEach(row => {
        let cantidad = parseFloat(row.querySelector('.cantidad')?.value || 0);
        let costo = parseFloat(row.querySelector('.costo')?.value || 0);
        let subtotal = cantidad * costo;
        row.querySelector('.subtotal').value = subtotal.toFixed(2);
        total += subtotal;
    });
    document.getElementById('totalCompra').value = total.toFixed(2);
}

// Inicializar eventos en la primera fila
attachEvents();
</script>
