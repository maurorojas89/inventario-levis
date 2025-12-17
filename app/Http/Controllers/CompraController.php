<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CompraModelo;
use App\Models\DetalleCompra;
use App\Models\ProductoModelo;
use App\Models\ProveedorModelo;

class CompraController extends Controller
{
    public function index()
    {
        $compras = CompraModelo::with('proveedor')->get();
        $proveedores = ProveedorModelo::all();
        $totalGeneral = CompraModelo::sum('total');

        return view('compras.index', compact('compras', 'proveedores', 'totalGeneral'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_proveedor' => 'required|exists:proveedor,id_proveedor',
            'fecha' => 'required|date',
            'estado' => 'required|string',
            'productos' => 'required|array|min:1',
        ]);

        DB::beginTransaction();
        try {
            $compra = new CompraModelo();
            $compra->id_proveedor = $request->id_proveedor;
            $compra->fecha = $request->fecha;
            $compra->estado = $request->estado;
            $compra->total = 0;
            $compra->save();

            $totalCompra = 0;

            foreach ($request->productos as $prod) {
                $producto = new ProductoModelo();
                $producto->nombreProducto = $prod['nombre'];
                $producto->precioProducto = $prod['costoUnitario'];
                $producto->stockProducto = $prod['cantidad'];
                $producto->estadoProducto = 'Activo';
                $producto->id_proveedor = $compra->id_proveedor;
                $producto->save();

                $detalle = new DetalleCompra();
                $detalle->id_compra = $compra->id_compra;
                $detalle->id_producto = $producto->id_producto;
                $detalle->cantidad = $prod['cantidad'];
                $detalle->costoUnitario = $prod['costoUnitario'];
                $detalle->subtotal = $prod['cantidad'] * $prod['costoUnitario'];
                $detalle->save();

                $totalCompra += $detalle->subtotal;
            }

            $compra->total = $totalCompra;
            $compra->save();

            DB::commit();
            return redirect()->route('compras.index')->with('success', 'Compra registrada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage()); // 👈 muestra el error real
        }
    }

    public function detalle($id)
    {
        $compra = CompraModelo::with(['proveedor','detalles.producto'])->findOrFail($id);
        return view('compras.detalle', compact('compra'));
    }
}
