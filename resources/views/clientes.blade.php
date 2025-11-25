@extends('layouts.app')

@section('title', 'Gestión de Clientes')

@section('content')
<div class="container">
    <h1 class="mb-4">Módulo Clientes</h1>

    {{-- Mensajes de éxito/error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Formulario para crear o editar cliente --}}
    <div class="card mb-4">
        <div class="card-header">
            {{ isset($cliente) ? 'Editar Cliente' : 'Añadir Cliente' }}
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

            <form action="{{ isset($cliente) ? route('clientes.update', $cliente->id_cliente) : route('clientes.store') }}" method="POST">
                @csrf
                @if(isset($cliente))
                    @method('PUT')
                @endif

                <div class="row mb-3">
                    <div class="col">
                        <label for="documentoCliente" class="form-label">Número de Documento</label>
                        <input type="text" name="documentoCliente" class="form-control" value="{{ old('documentoCliente', $cliente->documentoCliente ?? '') }}" required>
                    </div>
                    <div class="col">
                        <label for="tipoDocumentoCliente" class="form-label">Tipo de Documento</label>
                        <select name="tipoDocumentoCliente" class="form-select" required>
                            <option value="">Selecciona tipo de documento</option>
                            <option value="CC" {{ old('tipoDocumentoCliente', $cliente->tipoDocumentoCliente ?? '') == 'CC' ? 'selected' : '' }}>Cédula de ciudadanía</option>
                            <option value="TI" {{ old('tipoDocumentoCliente', $cliente->tipoDocumentoCliente ?? '') == 'TI' ? 'selected' : '' }}>Tarjeta de identidad</option>
                            <option value="CE" {{ old('tipoDocumentoCliente', $cliente->tipoDocumentoCliente ?? '') == 'CE' ? 'selected' : '' }}>Cédula de extranjería</option>
                            <option value="PA" {{ old('tipoDocumentoCliente', $cliente->tipoDocumentoCliente ?? '') == 'PA' ? 'selected' : '' }}>Pasaporte</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="nombreCliente" class="form-label">Nombre</label>
                        <input type="text" name="nombreCliente" class="form-control" value="{{ old('nombreCliente', $cliente->nombreCliente ?? '') }}" required>
                    </div>
                    <div class="col">
                        <label for="apellidoCliente" class="form-label">Apellido</label>
                        <input type="text" name="apellidoCliente" class="form-control" value="{{ old('apellidoCliente', $cliente->apellidoCliente ?? '') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="direccionCliente" class="form-label">Dirección</label>
                    <textarea name="direccionCliente" class="form-control">{{ old('direccionCliente', $cliente->direccionCliente ?? '') }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="telefonoCliente" class="form-label">Teléfono</label>
                        <input type="text" name="telefonoCliente" class="form-control" value="{{ old('telefonoCliente', $cliente->telefonoCliente ?? '') }}">
                    </div>
                    <div class="col">
                        <label for="emailCliente" class="form-label">Email</label>
                        <input type="email" name="emailCliente" class="form-control" value="{{ old('emailCliente', $cliente->emailCliente ?? '') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">
                    {{ isset($cliente) ? 'Actualizar Cliente' : 'Guardar Cliente' }}
                </button>
                @if(isset($cliente))
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar edición</a>
                @endif
            </form>
        </div>
    </div>

    {{-- Tabla de clientes --}}
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>DOCUMENTO</th>
                <th>TIPO</th>
                <th>NOMBRE COMPLETO</th>
                <th>DIRECCIÓN</th>
                <th>TELÉFONO</th>
                <th>EMAIL</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $c)
            <tr>
                <td>{{ $c->documentoCliente }}</td>
                <td>{{ $c->tipoDocumentoCliente }}</td>
                <td>{{ $c->nombreCliente }} {{ $c->apellidoCliente }}</td>
                <td>{{ $c->direccionCliente }}</td>
                <td>{{ $c->telefonoCliente }}</td>
                <td>{{ $c->emailCliente }}</td>
                <td>
                    <a href="{{ route('clientes.edit', $c->id_cliente) }}" class="btn btn-sm btn-outline-primary">Editar</a>

                    <form action="{{ route('clientes.destroy', $c->id_cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este cliente?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No hay clientes registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
