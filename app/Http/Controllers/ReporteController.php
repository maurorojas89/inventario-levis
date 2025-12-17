<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoModelo;
use App\Models\ClienteModelo;
use App\Models\ProveedorModelo;
use App\Models\ReporteModelo; // ✅ aquí importas el modelo

class ReporteController extends Controller
{
    public function index()
    {
        // Totales simples
        $totalClientes = ClienteModelo::count();
        $totalProveedores = ProveedorModelo::count();
        $totalProductos = ProductoModelo::count();

        // Totales financieros y balance
        $resumen = ReporteModelo::resumenFinanciero();

        // Agrupaciones mensuales
        $comprasMensuales = ReporteModelo::comprasMensuales();
        $ventasMensuales = ReporteModelo::ventasMensuales();

        return view('reportes', array_merge([
            'totalClientes' => $totalClientes,
            'totalProveedores' => $totalProveedores,
            'totalProductos' => $totalProductos,
            'comprasMensuales' => $comprasMensuales,
            'ventasMensuales' => $ventasMensuales,
        ], $resumen));
    }
}
