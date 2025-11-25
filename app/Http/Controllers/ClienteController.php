<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClienteModelo;

class ClienteController extends Controller
{
    // Mostrar listado de clientes
    public function index()
    {
        $clientes = ClienteModelo::all();
        return view('clientes', compact('clientes'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('clientes-create');
    }

    // Guardar nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'documentoCliente' => 'required|string|max:20|unique:cliente,documentoCliente',
            'tipoDocumentoCliente' => 'nullable|string|max:10',
            'nombreCliente' => 'required|string|max:100',
            'apellidoCliente' => 'required|string|max:100',
            'direccionCliente' => 'nullable|string',
            'telefonoCliente' => 'nullable|string|max:20|unique:cliente,telefonoCliente',
            'emailCliente' => 'nullable|email|max:100|unique:cliente,emailCliente',
        ]);

        ClienteModelo::create($request->only([
            'documentoCliente',
            'tipoDocumentoCliente',
            'nombreCliente',
            'apellidoCliente',
            'direccionCliente',
            'telefonoCliente',
            'emailCliente'
        ]));

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $cliente = ClienteModelo::findOrFail($id);
        $clientes = ClienteModelo::all();
        return view('clientes', compact('cliente', 'clientes'));
    }

    // Actualizar cliente
    public function update(Request $request, $id)
    {
        $cliente = ClienteModelo::findOrFail($id);

        $request->validate([
            'documentoCliente' => 'required|string|max:20|unique:cliente,documentoCliente,' . $id . ',id_cliente',
            'tipoDocumentoCliente' => 'nullable|string|max:10',
            'nombreCliente' => 'required|string|max:100',
            'apellidoCliente' => 'required|string|max:100',
            'direccionCliente' => 'nullable|string',
            'telefonoCliente' => 'nullable|string|max:20|unique:cliente,telefonoCliente,' . $id . ',id_cliente',
            'emailCliente' => 'nullable|email|max:100|unique:cliente,emailCliente,' . $id . ',id_cliente',
        ]);

        $cliente->update($request->only([
            'documentoCliente',
            'tipoDocumentoCliente',
            'nombreCliente',
            'apellidoCliente',
            'direccionCliente',
            'telefonoCliente',
            'emailCliente'
        ]));

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    // Eliminar cliente (sin verificación de pedidos)
    public function destroy($id)
    {
        try {
            ClienteModelo::findOrFail($id)->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'Error al eliminar el cliente: ' . $e->getMessage());
        }
    }
}
    