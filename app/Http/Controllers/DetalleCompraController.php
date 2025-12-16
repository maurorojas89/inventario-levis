<?php

namespace App\Http\Controllers;

// app/Http/Controllers/DetalleCompraController.php
use App\Models\DetalleCompra;
use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleCompraController extends Controller
{
    public function create($id)
    {
        $compra = Compra::with('proveedor')->findOrFail($id);
        $productos = Producto::where('rol_producto', $compra->proveedor->rol)->get();
        return view('compras.detalle_create', compact('compra', 'productos'));
    }

    public function store(Request $request, $id)
    {
        $subtotal = $request->cantidad * $request->precio_unitario;

        DetalleCompra::create([
            'id_compra' => $id,
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
            'subtotal' => $subtotal
        ]);

        $total = DetalleCompra::where('id_compra', $id)->sum('subtotal');
        Compra::where('id_compra', $id)->update(['total' => $total]);

        return redirect()->route('detalleCompra.create', ['id' => $id]);
    }
}
