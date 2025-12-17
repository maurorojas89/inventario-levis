<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\CompraModelo;
use App\Models\VentaModelo;

class ReporteModelo extends Model

{
    // Si no tienes tabla propia para reportes, puedes dejarlo sin $table

    public static function resumenFinanciero()
{
    $totalCompras = CompraModelo::sum('total');     // usa el nombre real de la columna
    $totalVentas  = VentaModelo::sum('totalVenta'); // ajusta al nombre real en ventas

    return [
        'totalCompras' => $totalCompras,
        'totalVentas'  => $totalVentas,
        'balance'      => $totalVentas - $totalCompras, // 👉 agregado
    ];
}

    public static function comprasMensuales()
    {
        return CompraModelo::selectRaw('MONTH(fecha) as mes, SUM(total) as total')
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();
    }

    public static function ventasMensuales()
    {
        return VentaModelo::selectRaw('MONTH(created_at) as mes, SUM(totalVenta) as total')
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();
    }
}
