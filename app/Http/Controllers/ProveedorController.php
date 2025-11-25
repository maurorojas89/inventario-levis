<?php

namespace App\Http\Controllers;

use App\Models\ProveedorModelo;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = ProveedorModelo::orderByDesc('id_proveedor')->get();
        return view('proveedores', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreProveedor'   => 'required|string|max:100',
            'telefonoProveedor' => 'nullable|string|max:20',
            'correoProveedor'   => 'nullable|email|max:100'
        ]);

        ProveedorModelo::create($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado correctamente.');
    }

    public function destroy($id)
    {
        $proveedor = ProveedorModelo::findOrFail($id);
        $proveedor->delete();

        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado.');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'nombreProveedor'   => 'required|string|max:100',
        'empresa'           => 'nullable|string|max:100',
        'rolProveedor'      => 'nullable|string|max:50',
        'telefonoProveedor' => 'nullable|string|max:20',
        'correoProveedor'   => 'nullable|email|max:100',
        'direccion'         => 'nullable|string'
    ]);

    $proveedor = ProveedorModelo::findOrFail($id);
    $proveedor->update($request->all());

    return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
}

}
