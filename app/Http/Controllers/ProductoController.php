<?php

namespace App\Http\Controllers;

use App\Models\ProductoModelo;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = ProductoModelo::all();
        return view('productos', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreProducto' => 'required|string|max:100',
            'precioProducto' => 'required|numeric|min:0',
            'stockProducto' => 'required|integer|min:0',
        ]);

        ProductoModelo::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto guardado correctamente.');
    }

    public function edit($id)
    {
        $producto = ProductoModelo::findOrFail($id);
        $productos = ProductoModelo::all();
        return view('productos', compact('producto', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $producto = ProductoModelo::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        ProductoModelo::findOrFail($id)->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }
}
