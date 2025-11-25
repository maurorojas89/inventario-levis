@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-4">Módulo Herramientas 🔧</h1>

  <!-- Mensaje de éxito -->
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <!-- Buscar -->
  <div class="mb-3 d-flex justify-content-between">
    <input type="text" class="form-control w-50" placeholder="Buscar por nombre o unidad" id="busqueda">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalHerramienta">+ Nueva herramienta</button>
  </div>

  <!-- Tabla -->
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Unidad</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="tablaHerramientas">
      @foreach($herramientas as $h)
        <tr>
          <td>{{ $h->nombre }}</td>
          <td>{{ $h->descripcion }}</td>
          <td>{{ $h->cantidad }}</td>
          <td>{{ $h->unidad }}</td>
          <td>
            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $h->id_herramienta }}">Editar</button>
            <form action="{{ route('herramienta.destroy', $h->id_herramienta) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar herramienta?')">Eliminar</button>
            </form>
          </td>
        </tr>

        <!-- Modal Editar -->
        <div class="modal fade" id="modalEditar{{ $h->id_herramienta }}" tabindex="-1">
          <div class="modal-dialog">
            <form action="{{ route('herramienta.update', $h->id_herramienta) }}" method="POST" class="modal-content">
              @csrf @method('PUT')
              <div class="modal-header"><h5 class="modal-title">Editar herramienta</h5></div>
              <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">Nombre</label>
                  <input type="text" name="nombre" class="form-control" value="{{ $h->nombre }}" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Descripción</label>
                  <textarea name="descripcion" class="form-control">{{ $h->descripcion }}</textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Cantidad</label>
                  <input type="number" name="cantidad" class="form-control" value="{{ $h->cantidad }}" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Unidad</label>
                  <input type="text" name="unidad" class="form-control" value="{{ $h->unidad }}">
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-success">Guardar cambios</button>
              </div>
            </form>
          </div>
        </div>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Modal Crear -->
<div class="modal fade" id="modalHerramienta" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('herramienta.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header"><h5 class="modal-title">Nueva herramienta</h5></div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Descripción</label>
          <textarea name="descripcion" class="form-control"></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Cantidad</label>
          <input type="number" name="cantidad" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Unidad</label>
          <input type="text" name="unidad" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary">Guardar herramienta</button>
      </div>
    </form>
  </div>
</div>

<!-- Script de búsqueda -->
<script>
  document.getElementById('busqueda').addEventListener('input', function () {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaHerramientas tr');
    filas.forEach(fila => {
      const texto = fila.textContent.toLowerCase();
      fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
  });
</script>
@endsection
