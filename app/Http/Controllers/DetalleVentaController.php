<?php

namespace App\Http\Controllers;

use App\Models\VentaModelo;
use App\Models\ProductoModelo;
use App\Models\DetalleVentaModelo;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function index($id)
    {
        $venta = VentaModelo::with('cliente')->findOrFail($id);
        $productos = ProductoModelo::orderBy('nombreProducto')->get();
        $detalles = DetalleVentaModelo::with('producto')
            ->where('id_venta', $id)
            ->orderByDesc('id_detalle')
            ->get();

        return view('detalleVenta', compact('venta', 'productos', 'detalles'));
    }

    public function store(Request $request, $id)
    {
        $venta = VentaModelo::findOrFail($id);

        $request->validate([
            'id_producto'    => 'required|exists:producto,id_producto',
            'cantidad'       => 'required|integer|min:1',
            'precioUnitario' => 'required|numeric|min:0'
        ]);

        DetalleVentaModelo::create([
            'id_venta'       => $venta->id_venta,
            'id_producto'    => $request->id_producto,
            'cantidad'       => $request->cantidad,
            'precioUnitario' => $request->precioUnitario,
        ]);

        // ✅ Actualiza el total después de agregar
        $this->actualizarTotalVenta($venta->id_venta);

        return redirect()->route('detalleVenta.index', $venta->id_venta)
            ->with('success', 'Producto agregado a la venta.');
    }

    public function destroy($id, $detalleId)
    {
        $venta = VentaModelo::findOrFail($id);
        $detalle = DetalleVentaModelo::where('id_venta', $venta->id_venta)
            ->findOrFail($detalleId);

        $detalle->delete();

        // ✅ Actualiza el total después de eliminar
        $this->actualizarTotalVenta($venta->id_venta);

        return redirect()->route('detalleVenta.index', $venta->id_venta)
            ->with('success', 'Detalle eliminado.');
    }

    // ✅ Función que recalcula el total de la venta
    private function actualizarTotalVenta($id_venta)
    {
        $total = DetalleVentaModelo::where('id_venta', $id_venta)->sum('subtotal');
        VentaModelo::where('id_venta', $id_venta)->update(['totalVenta' => $total]);
    }
}
