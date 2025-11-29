<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoModelo;
use App\Models\ClienteModelo;
use App\Models\ProveedorModelo;
use App\Models\ReporteModelo;

class ReporteController extends Controller
{
    public function index()
    {
        // Totales simples
        $totalClientes = ClienteModelo::count();
        $totalProveedores = ProveedorModelo::count();
        $totalProductos = ProductoModelo::count();

        // Totales financieros y balance
        $resumen = ReporteModelo::resumenFinanciero(); // usa tabla 'compra'

        // Agrupaciones mensuales
        $comprasMensuales = ReporteModelo::comprasMensuales(); // usa tabla 'compra'
        $ventasMensuales = ReporteModelo::ventasMensuales();   // usa tabla 'ventas'

        // Enviar todo a la vista
        return view('reportes', array_merge([
            'totalClientes' => $totalClientes,
            'totalProveedores' => $totalProveedores,
            'totalProductos' => $totalProductos,
            'comprasMensuales' => $comprasMensuales,
            'ventasMensuales' => $ventasMensuales,
        ], $resumen));
    }
}
