<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompraModelo;
use App\Models\DetalleCompra;
use App\Models\ProveedorModelo;
use App\Models\ProductoModelo;

class CompraController extends Controller
{
    public function index()
    {
        $compras = CompraModelo::with('proveedor')->orderByDesc('id_compra')->get();
        $proveedores = ProveedorModelo::all();
        $productos = ProductoModelo::all();

        return view('compras', compact('compras', 'proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_proveedor' => 'required|exists:proveedor,id_proveedor',
            'fechaCompra' => 'required|date',
            'estadoCompra' => 'required|string|max:20',
            'productos' => 'required|array|min:1',
            'productos.*.id_producto' => 'required|exists:producto,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precioUnitario' => 'required|numeric|min:0'
        ]);

        $compra = CompraModelo::create([
            'id_proveedor' => $request->id_proveedor,
            'fechaCompra' => $request->fechaCompra,
            'estadoCompra' => $request->estadoCompra,
            'totalCompra' => 0
        ]);

        $total = 0;
        foreach ($request->productos as $item) {
            $subtotal = $item['cantidad'] * $item['precioUnitario'];
            DetalleCompra::create([
                'id_compra' => $compra->id_compra,
                'id_producto' => $item['id_producto'],
                'cantidad' => $item['cantidad'],
                'precioUnitario' => $item['precioUnitario']
            ]);
            $total += $subtotal;
        }

        $compra->update(['totalCompra' => $total]);

        return redirect()->route('compras.index')->with('success', 'Compra registrada correctamente.');
    }
}
