<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoModelo extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
    'nombreProducto',
    'descripcionProducto',
    'precioProducto',
    'stockProducto',
    'estadoProducto',
    'id_proveedor' // este sí existe en la tabla
];

public function proveedor()
{
    return $this->belongsTo(ProveedorModelo::class, 'id_proveedor');
}

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'id_producto');
    }
}
