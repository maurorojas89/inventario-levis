<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompraModelo extends Model
{
    protected $table = 'detalle_compra';
    protected $primaryKey = 'id_detalle';
    protected $fillable = [
        'id_compra',
        'id_producto',
        'cantidad',
        'costoUnitario'
    ];

    public function compra()
    {
        return $this->belongsTo(CompraModelo::class, 'id_compra', 'id_compra');
    }

    public function producto()
    {
        return $this->belongsTo(ProductoModelo::class, 'id_producto', 'id_producto');
    }
}
