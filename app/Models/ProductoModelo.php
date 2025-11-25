<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoModelo extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'nombreProducto',
        'descripcionProducto',
        'precioProducto',
        'stockProducto',
        'estadoProducto'
    ];
    public $timestamps = false;

}
