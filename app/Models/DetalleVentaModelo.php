<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVentaModelo extends Model
{
    protected $table = 'detalle_venta';
    protected $primaryKey = 'id_detalle';
    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precioUnitario',
        'subtotal' // nuevo campo para el total por línea
    ];

    public function venta()
    {
        return $this->belongsTo(VentaModelo::class, 'id_venta', 'id_venta');
    }

    public function producto()
    {
        return $this->belongsTo(ProductoModelo::class, 'id_producto', 'id_producto');
    }
}
