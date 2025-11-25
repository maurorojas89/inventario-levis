<?php

namespace App\Http\Controllers;

use App\Models\ClienteModelo;
use Illuminate\Http\Request;
use App\Models\VentaModelo;

class VentaController extends Controller
{
    public function index()
{
    $clientes = ClienteModelo::all();
    $ventas = VentaModelo::with('cliente')->get();
    return view('ventas', compact('clientes', 'ventas'));
}

public function edit($id)
{
    $venta = VentaModelo::findOrFail($id);
    $clientes = ClienteModelo::all();
    $ventas = VentaModelo::with('cliente')->get();
    return view('ventas', compact('venta', 'clientes', 'ventas'));
}

public function store(Request $request)
{
    $request->validate([
        'id_cliente' => 'required|exists:cliente,id_cliente',
        'fechaVenta' => 'required|date',
        'estadoVenta' => 'required|string|max:20',
    ]);

    VentaModelo::create($request->only(['id_cliente', 'fechaVenta', 'estadoVenta']));

    return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
}


   public function update(Request $request, $id)
{
    $venta = VentaModelo::findOrFail($id);

    $request->validate([
        'id_cliente' => 'required|exists:cliente,id_cliente',
        'fechaVenta' => 'required|date',
        'estadoVenta' => 'required|string|max:20',
    ]);

    $venta->update($request->only(['id_cliente', 'fechaVenta', 'estadoVenta']));

    return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
}

   public function destroy($id)
{
    $venta = VentaModelo::findOrFail($id);
    $venta->delete();

    return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
}

}  
