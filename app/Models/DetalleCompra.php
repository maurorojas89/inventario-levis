<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected $table = 'detalle_compra';
    protected $primaryKey = 'id_detalle';
    public $timestamps = true;

    protected $fillable = [
        'id_compra',
        'id_producto',
        'cantidad',
        'costoUnitario'
    ];

    public function producto()
    {
        return $this->belongsTo(ProductoModelo::class, 'id_producto');
    }

    public function compra()
    {
        return $this->belongsTo(CompraModelo::class, 'id_compra');
    }
}
