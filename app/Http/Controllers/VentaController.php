<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentaModelo;
use App\Models\DetalleVentaModelo;
use App\Models\ProductoModelo;
use App\Models\ClienteModelo;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    // Mostrar formulario y listado
    public function index()
    {
        $ventas = VentaModelo::with(['cliente', 'detalles.producto'])->orderByDesc('id_venta')->get();
        $clientes = ClienteModelo::orderBy('nombreCliente')->get();
        $productos = ProductoModelo::orderBy('nombreProducto')->get();

        return view('ventas', compact('ventas', 'clientes', 'productos'));
    }

    // Registrar venta
public function store(Request $request)
{
    try {
        // 🔍 Paso 1: Ver qué llega desde el formulario
        // dd($request->all());

        // 🔍 Paso 2: Filtrar filas vacías
        $itemsFiltrados = collect($request->items)->filter(function ($item) {
            return isset($item['id_producto'], $item['cantidad']) && $item['cantidad'] > 0;
        })->values()->all();

        // 🔍 Paso 3: Ver qué quedó después del filtrado
        //
         // dd($itemsFiltrados);

        // 🔧 Paso 4: Reemplazar los items originales por los filtrados
        $request->merge(['items' => $itemsFiltrados]);

        // 🔍 Paso 5: Ver cómo queda el request final antes de validar
         // dd($request->all());

        // ✅ Paso 6: Validación
        $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'fechaVenta' => 'required|date',
            'estadoVenta' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.id_producto' => 'required|exists:productos,id_producto',
            'items.*.cantidad' => 'required|integer|min:1',
        ]);

        // 🧱 Paso 7: Crear la venta
        $venta = VentaModelo::create([
            'id_cliente' => $request->id_cliente,
            'fechaVenta' => $request->fechaVenta,
            'estadoVenta' => $request->estadoVenta,
            'totalVenta' => $request->totalVenta,
        ]);

        // 🧱 Paso 8: Crear los detalles
        foreach ($request->items as $item) {
            $producto = ProductoModelo::findOrFail($item['id_producto']);
            $precioUnitario = (float) $producto->precioProducto;
            $cantidad = (int) $item['cantidad'];
            $subtotal = $precioUnitario * $cantidad;

            DetalleVentaModelo::create([
                'id_venta' => $venta->id_venta,
                'id_producto' => $producto->id_producto,
                'cantidad' => $cantidad,
                'precioUnitario' => $precioUnitario,
                //'subtotal' => $subtotal,
            ]);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
    } catch (\Throwable $e) {
        return back()->withErrors(['error' => 'Error al registrar la venta: ' . $e->getMessage()]);
    }
 }
    
 
     public function destroy($id)
     {
    try {
        // Eliminar detalles primero
        DetalleVentaModelo::where('id_venta', $id)->delete();

        // Luego eliminar la venta
        VentaModelo::destroy($id);

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    } catch (\Throwable $e) {
        return back()->withErrors(['error' => 'Error al eliminar la venta: ' . $e->getMessage()]);
    }
}
public function show($id)
{
    try {
        // Buscar la venta con sus relaciones
        $venta = VentaModelo::with([
            'cliente',              // relación con cliente
            'detalles.producto'     // relación con productos vendidos
        ])->findOrFail($id);

        // Retornar la vista con la venta cargada
        return view('ventas.show', compact('venta'));
    } catch (\Throwable $e) {
        return back()->withErrors(['error' => 'No fue posible cargar el detalle de la venta: ' . $e->getMessage()]);
    }
}



}