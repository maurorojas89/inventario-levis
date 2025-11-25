<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoModelo;
use App\Models\ClienteModelo;
use App\Models\ProveedorModelo;
use App\Models\CompraModelo;
use App\Models\VentaModelo;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        // Totales simples
        $totalClientes = ClienteModelo::count();
        $totalProveedores = ProveedorModelo::count();
        $totalProductos = ProductoModelo::count();

        // Totales de compras y ventas
        $totalCompras = CompraModelo::sum('total');
        $totalVentas = VentaModelo::sum('total');
        $balance = $totalVentas - $totalCompras;

        // Agrupación mensual
        $comprasMensuales = CompraModelo::select(
          DB::raw('MONTH(fecha) as mes'),
          DB::raw('SUM(total) as total')
        )->groupBy('mes')->get();


        $ventasMensuales = VentaModelo::select(
            DB::raw('MONTH(fecha) as mes'),
            DB::raw('SUM(total) as total')
        )->groupBy('mes')->get();

        return view('reportes', compact(
            'totalClientes',
            'totalProveedores',
            'totalProductos',
            'totalCompras',
            'totalVentas',
            'balance',
            'comprasMensuales',
            'ventasMensuales'
        ));
    }
}
