@extends('layouts.app')

@section('title', 'Gestión de Ventas')

@section('content')
<div class="container">
    <h1 class="mb-4">Módulo Ventas</h1>

    {{-- Mensajes de éxito/error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Formulario para crear o editar venta --}}
    <div class="card mb-4">
        <div class="card-header">
            {{ isset($venta) ? 'Editar Venta' : 'Registrar Venta' }}
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

            <form action="{{ isset($venta) ? route('ventas.update', $venta->id_venta) : route('ventas.store') }}" method="POST">
                @csrf
                @if(isset($venta))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="id_cliente" class="form-label">Cliente</label>
                    <select name="id_cliente" class="form-select" required>
                        <option value="">Selecciona un cliente</option>
                        @foreach($clientes as $c)
                            <option value="{{ $c->id_cliente }}"
                                {{ old('id_cliente', $venta->id_cliente ?? '') == $c->id_cliente ? 'selected' : '' }}>
                                {{ $c->nombreCliente }} {{ $c->apellidoCliente }} — {{ $c->documentoCliente }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fechaVenta" class="form-label">Fecha de Venta</label>
                    <input type="date" name="fechaVenta" class="form-control"
                        value="{{ old('fechaVenta', $venta->fechaVenta ?? date('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="estadoVenta" class="form-label">Estado</label>
                    <select name="estadoVenta" class="form-select" required>
                        <option value="completada" {{ old('estadoVenta', $venta->estadoVenta ?? '') == 'completada' ? 'selected' : '' }}>Completada</option>
                        <option value="pendiente" {{ old('estadoVenta', $venta->estadoVenta ?? '') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="cancelada" {{ old('estadoVenta', $venta->estadoVenta ?? '') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    {{ isset($venta) ? 'Actualizar Venta' : 'Registrar Venta' }}
                </button>
                @if(isset($venta))
                    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar edición</a>
                @endif
            </form>
        </div>
    </div>

    {{-- Tabla de ventas --}}
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ventas as $v)
            <tr>
                <td>#{{ $v->id_venta }}</td>
                <td>{{ $v->cliente->nombreCliente }} {{ $v->cliente->apellidoCliente }}</td>
                <td>{{ \Carbon\Carbon::parse($v->fechaVenta)->format('Y-m-d') }}</td>
                <td>{{ ucfirst($v->estadoVenta) }}</td>
                <td>
                    <a href="{{ route('ventas.edit', $v->id_venta) }}" class="btn btn-sm btn-outline-primary">Editar</a>

                    <form action="{{ route('ventas.destroy', $v->id_venta) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta venta?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No hay ventas registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
