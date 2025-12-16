<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompraModelo;
use App\Models\DetalleCompra;
use App\Models\ProveedorModelo;
use App\Models\ProductoModelo;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'id_proveedor' => 'required|exists:proveedor,id_proveedor',
            'fecha' => 'required|date',
            'estado' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 1. Crear la compra
            $compra = new CompraModelo();
            $compra->id_proveedor = $request->id_proveedor;
            $compra->fecha = $request->fecha;
            $compra->estado = $request->estado;
            $compra->total = 0; // se recalcula luego
            $compra->save();

            // 2. Guardar productos existentes
            if ($request->has('productos')) {
                foreach ($request->productos as $prod) {
                    $producto = ProductoModelo::find($prod['id_producto']);
                    if ($producto) {
                        // Actualizar stock
                        $producto->stockProducto += $prod['cantidad'];

                        // Asegurar que el producto quede ligado al proveedor de la compra
                        if (empty($producto->id_proveedor)) {
                            $producto->id_proveedor = $compra->id_proveedor;
                        }

                        $producto->save();

                        // Guardar detalle de compra
                        $detalle = new DetalleCompra();
                        $detalle->id_compra = $compra->id_compra;
                        $detalle->id_producto = $producto->id_producto;
                        $detalle->cantidad = $prod['cantidad'];
                        // Usa el nombre real de la columna en tu tabla
                        $detalle->precio_unitario = $prod['precio_unitario'];
                        $detalle->subtotal = $prod['cantidad'] * $prod['precio_unitario'];
                        $detalle->save();
                    }
                }
            }

            // 3. Guardar nuevo producto si existe
            if ($request->filled('nuevo_nombre')) {
                $nuevo = new ProductoModelo();
                $nuevo->nombreProducto = $request->nuevo_nombre;
                $nuevo->descripcionProducto = $request->nuevo_descripcion;
                $nuevo->precioProducto = $request->nuevo_precio;
                $nuevo->stockProducto = $request->nuevo_stock;
                $nuevo->estadoProducto = 'Activo';
                $nuevo->id_proveedor = $compra->id_proveedor;
                $nuevo->save();

                // Guardar detalle de compra para el nuevo producto
                $detalle = new DetalleCompra();
                $detalle->id_compra = $compra->id_compra;
                $detalle->id_producto = $nuevo->id_producto;
                $detalle->cantidad = $request->nuevo_stock;
                $detalle->precio_unitario = $request->nuevo_precio;
                $detalle->subtotal = $request->nuevo_stock * $request->nuevo_precio;
                $detalle->save();
            }

            // 4. Recalcular total de la compra
            $compra->total = DetalleCompra::where('id_compra', $compra->id_compra)->sum('subtotal');
            $compra->save();

            DB::commit();
            return redirect()->route('compras.index')->with('success', 'Compra registrada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al registrar la compra: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $compras = CompraModelo::with('proveedor')->get();
        $proveedores = ProveedorModelo::all();
        $productos = ProductoModelo::all();

        return view('compras.index', compact('compras', 'proveedores', 'productos'));
    }
}   