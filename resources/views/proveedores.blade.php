@extends('layouts.app')

@section('title', 'Gestión de Proveedores')

@section('content')
<style>
    body {
        background-color: #1a1a1a;
        color: #fff;
    }
    h1 {
        color: #C70202;
        text-align: center;
        margin-bottom: 30px;
    }
    .card {
        background-color: #2a2a2a;
        border: none;
        box-shadow: 0 0 15px rgba(0,0,0,0.5);
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
        border: 1px solid #444;
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
    .table {
        background-color: #2a2a2a;
        color: #fff;
    }
    .table thead {
        background-color: #C70202;
        color: #fff;
    }
    .btn-outline-primary {
        border-color: #C70202;
        color: #C70202;
    }
    .btn-outline-primary:hover {
        background-color: #C70202;
        color: #fff;
    }
    .btn-outline-danger {
        border-color: #ff4444;
        color: #ff4444;
    }
    .btn-outline-danger:hover {
        background-color: #ff4444;
        color: #fff;
    }
    .modal-content {
        background-color: #2a2a2a;
        color: #fff;
    }
    .modal-header {
        background-color: #C70202;
        color: #fff;
    }
    .modal-footer {
        background-color: #1a1a1a;
    }
</style>

<div class="container">
    <h1>Módulo Proveedores</h1>

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
        <div class="card-header">Registrar Proveedor</div>
        <div class="card-body">
            <form method="POST" action="{{ route('proveedores.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombreProveedor" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Empresa</label>
                        <input type="text" name="empresa" class="form-control" value="Levi's" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Rol</label>
                        <select name="rolProveedor" class="form-select" required>
                            <option value="">Selecciona rol</option>
                            <option value="Prendas de cabeza">Prendas de cabeza</option>
                            <option value="Camisetas">Camisetas</option>
                            <option value="Camisas">Camisas</option>
                            <option value="Pantalones">Pantalones</option>
                            <option value="Zapatos">Zapatos</option>
                            <option value="Interiores">Interiores</option>
                            <option value="Chaquetas">Chaquetas</option>
                            <option value="Accesorios">Accesorios</option>
                            <option value="Ropa infantil">Ropa infantil</option>
                            <option value="Ropa deportiva">Ropa deportiva</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefonoProveedor" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Correo</label>
                        <input type="email" name="correoProveedor" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Dirección</label>
                        <textarea name="direccion" class="form-control" rows="1"></textarea>
                    </div>
                </div>
                <div class="mt-3 text-end">
                    <button class="btn btn-success">Registrar Proveedor</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Empresa</th>
                <th>Rol</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proveedores as $p)
            <tr>
                <td>{{ $p->id_proveedor }}</td>
                <td>{{ $p->nombreProveedor }}</td>
                <td>{{ $p->empresa ?? '—' }}</td>
                <td>{{ $p->rolProveedor ?? '—' }}</td>
                <td>{{ $p->telefonoProveedor ?? '—' }}</td>
                <td>{{ $p->correoProveedor ?? '—' }}</td>
                <td>{{ $p->direccion ?? '—' }}</td>
                <td>
                    <form action="{{ route('proveedores.destroy', $p->id_proveedor) }}" method="POST" onsubmit="return confirm('¿Eliminar este proveedor?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                    </form>
                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editarProveedor{{ $p->id_proveedor }}">Editar</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No hay proveedores registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Modales de edición --}}
    @foreach($proveedores as $p)
    <div class="modal fade" id="editarProveedor{{ $p->id_proveedor }}" tabindex="-1" aria-labelledby="editarProveedorLabel{{ $p->id_proveedor }}" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('proveedores.update', $p->id_proveedor) }}">
          @csrf
          @method('PUT')
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editarProveedorLabel{{ $p->id_proveedor }}">Editar proveedor #{{ $p->id_proveedor }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label">Nombre</label>
                  <input type="text" name="nombreProveedor" class="form-control" value="{{ $p->nombreProveedor }}" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Empresa</label>
                  <input type="text" name="empresa" class="form-control" value="{{ $p->empresa }}">
                </div>
                <div class="col-md-4">
  <label class="form-label">Rol</label>
  <select name="rolProveedor" class="form-select">
    @foreach([
        'Prendas de cabeza',
        'Camisetas',
        'Camisas',
        'Pantalones',
        'Zapatos',
        'Interiores',
        'Chaquetas',
        'Accesorios',
        'Ropa infantil',
        'Ropa deportiva'
    ] as $rol)
      <option value="{{ $rol }}" {{ $p->rolProveedor === $rol ? 'selected' : '' }}>
        {{ $rol }}
      </option>
    @endforeach
  </select>
</div>
            </div> <!-- cierre row -->
          </div> <!-- cierre modal-body -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </div> <!-- cierre modal-content -->
      </form>
    </div> <!-- cierre modal-dialog -->
  </div> <!-- cierre modal -->
@endforeach
</div> <!-- cierre container -->
@endsection
