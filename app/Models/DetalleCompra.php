<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected $table = 'detalle_compra';
    protected $primaryKey = 'id_detalle';
    public $timestamps = false;

    protected $fillable = [
        'id_compra',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];

    // Relación con la compra
    public function compra()
    {
        return $this->belongsTo(CompraModelo::class, 'id_compra');
    }

    // Relación con el producto
    public function producto() {
    return $this->belongsTo(ProductoModelo::class, 'id_producto', 'id_producto');
}

}
