<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReporteModelo extends Model
{
    protected $table = null; // No vinculada a una tabla directa
    public $timestamps = false;

    public static function comprasMensuales()
    {
        return DB::table('compra')
            ->select(DB::raw('MONTH(fechaCompra) as mes'), DB::raw('SUM(totalCompra) as total'))
            ->groupBy(DB::raw('MONTH(fechaCompra)'))
            ->orderBy(DB::raw('MONTH(fechaCompra)'))
            ->get();
    }

    public static function ventasMensuales()
    {
        return DB::table('ventas')
            ->select(DB::raw('MONTH(fechaVenta) as mes'), DB::raw('SUM(totalVenta) as total'))
            ->groupBy(DB::raw('MONTH(fechaVenta)'))
            ->orderBy(DB::raw('MONTH(fechaVenta)'))
            ->get();
    }

    public static function resumenFinanciero()
    {
        $totalCompras = DB::table('compra')->sum('totalCompra');
        $totalVentas = DB::table('ventas')->sum('totalVenta');
        $balance = $totalVentas - $totalCompras;

        return compact('totalCompras', 'totalVentas', 'balance');
    }
}
