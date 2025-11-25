<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HerramientaModelo;

class HerramientaController extends Controller
{
    public function index()
    {
        $herramientas = HerramientaModelo::orderBy('id_herramienta', 'desc')->get();
        return view('herramientas', compact('herramientas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
            'unidad' => 'nullable|string|max:20',
        ]);

        HerramientaModelo::create($request->all());
        return redirect()->route('herramienta.index')->with('success', 'Herramienta registrada');
    }

    public function update(Request $request, $id)
    {
        $herramienta = HerramientaModelo::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
            'unidad' => 'nullable|string|max:20',
        ]);

        $herramienta->update($request->all());
        return redirect()->route('herramienta.index')->with('success', 'Herramienta actualizada');
    }

    public function destroy($id)
    {
        HerramientaModelo::findOrFail($id)->delete();
        return redirect()->route('herramienta.index')->with('success', 'Herramienta eliminada');
    }
}

