@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Agregar Productos a la Compra</h2>
    <form method="POST" action="{{ route('detalleCompra.store', $compra->id_compra) }}">
        @csrf
        <label>Producto:</label>
        <select name="id_producto" required>
            @foreach($productos as $p)
                <option value="{{ $p->id_producto }}">{{ $p->nombreProducto }}</option>
            @endforeach
        </select>

        <label>Cantidad:</label>
        <input type="number" name="cantidad" required>

        <label>Precio Unitario:</label>
        <input type="number" step="0.01" name="precio_unitario" required>

        <button type="submit">Agregar</button>
    </form>
</div>
@endsection
