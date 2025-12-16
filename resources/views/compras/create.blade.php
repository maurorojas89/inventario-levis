@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar Compra</h2>
    <form method="POST" action="{{ route('compras.store') }}">
        @csrf
        <label>Proveedor:</label>
        <select name="id_proveedor" required>
            @foreach($proveedores as $p)
             <option value="{{ $p->id_proveedor }}">{{ $p->nombreProveedor }}</option>
            @endforeach
        </select>

        <label>Fecha:</label>
        <input type="date" name="fecha" required>

        <label>Estado:</label>
        <select name="estado">
            <option value="Pendiente">Pendiente</option>
            <option value="Completado">Completado</option>
        </select>

        <button type="submit">Registrar Compra</button>
    </form>
</div>
@endsection
