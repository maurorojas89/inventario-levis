<?php

namespace App\Http\Controllers;

use App\Models\CompraModelo;
use App\Models\ProductoModelo;
use App\Models\DetalleCompraModelo;
use Illuminate\Http\Request;

class DetalleCompraController extends Controller
{
    public function index($id)
    {
        $compra = CompraModelo::with('proveedor')->findOrFail($id);
        $productos = ProductoModelo::orderBy('nombreProducto')->get();
        $detalles = DetalleCompraModelo::with('producto')
            ->where('id_compra', $id)
            ->orderByDesc('id_detalle')
            ->get();

        return view('detalleCompra', compact('compra', 'productos', 'detalles'));
    }

    public function store(Request $request, $id)
    {
        $compra = CompraModelo::findOrFail($id);

        $request->validate([
            'id_producto'    => 'required|exists:producto,id_producto',
            'cantidad'       => 'required|integer|min:1',
            'costoUnitario'  => 'required|numeric|min:0'
        ]);

        DetalleCompraModelo::create([
            'id_compra'      => $compra->id_compra,
            'id_producto'    => $request->id_producto,
            'cantidad'       => $request->cantidad,
            'costoUnitario'  => $request->costoUnitario,
        ]);

        $this->actualizarTotalCompra($compra->id_compra);

        return redirect()->route('detalleCompra.index', $compra->id_compra)
            ->with('success', 'Producto agregado a la compra.');
    }

    public function destroy($id, $detalleId)
    {
        $compra = CompraModelo::findOrFail($id);
        $detalle = DetalleCompraModelo::where('id_compra', $compra->id_compra)
            ->findOrFail($detalleId);

        $detalle->delete();

        $this->actualizarTotalCompra($compra->id_compra);

        return redirect()->route('detalleCompra.index', $compra->id_compra)
            ->with('success', 'Detalle eliminado.');
    }

    private function actualizarTotalCompra($id_compra)
    {
        $total = DetalleCompraModelo::where('id_compra', $id_compra)->sum('subtotal');
        CompraModelo::where('id_compra', $id_compra)->update(['totalCompra' => $total]);
    }
}
