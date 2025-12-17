@extends('layouts.app')

@section('title', 'Gestión de Productos')

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
</style>

<div class="container">
    <h1>Módulo Productos</h1>

    {{-- Mensajes de éxito/error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Formulario para crear o editar producto --}}
    <div class="card mb-4">
        <div class="card-header">
            {{ isset($producto) ? 'Editar Producto' : 'Añadir Producto' }}
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Errores:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($producto) ? route('productos.update', $producto->id_producto) : route('productos.store') }}" method="POST">
                @csrf
                @if(isset($producto))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                    <input type="text" name="nombreProducto" class="form-control" value="{{ old('nombreProducto', $producto->nombreProducto ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="descripcionProducto" class="form-label">Descripción</label>
                    <textarea name="descripcionProducto" class="form-control">{{ old('descripcionProducto', $producto->descripcionProducto ?? '') }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="precioProducto" class="form-label">Precio</label>
                        <input type="number" step="0.01" name="precioProducto" class="form-control" value="{{ old('precioProducto', $producto->precioProducto ?? '') }}" required>
                    </div>
                    <div class="col">
                        <label for="stockProducto" class="form-label">Stock</label>
                        <input type="number" name="stockProducto" class="form-control" value="{{ old('stockProducto', $producto->stockProducto ?? '') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="estadoProducto" class="form-label">Estado</label>
                    <select name="estadoProducto" class="form-select">
                        <option value="activo" {{ old('estadoProducto', $producto->estadoProducto ?? '') == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ old('estadoProducto', $producto->estadoProducto ?? '') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    {{ isset($producto) ? 'Actualizar Producto' : 'Guardar Producto' }}
                </button>
                @if(isset($producto))
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar edición</a>
                @endif
            </form>
        </div>
    </div>

    {{-- Tabla de productos --}}
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $p)
            <tr>
                <td>{{ $p->id_producto }}</td>
                <td>{{ $p->nombreProducto }}</td>
                <td>{{ $p->descripcionProducto }}</td>
                <td>${{ number_format($p->precioProducto, 2) }}</td>
                <td>{{ $p->stockProducto }}</td>
                <td>{{ ucfirst($p->estadoProducto) }}</td>
                <td>
                    <a href="{{ route('productos.edit', $p->id_producto) }}" class="btn btn-sm btn-outline-primary">Editar</a>

                    <form action="{{ route('productos.destroy', $p->id_producto) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este producto?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No hay productos registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
