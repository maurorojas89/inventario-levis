<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompraModelo extends Model
{
    protected $table = 'compra'; // singular
    protected $primaryKey = 'id_compra';

    protected $fillable = [
        'id_proveedor',
        'fecha',
        'estado',
        'total',
    ];

    public function proveedor()
    {
        return $this->belongsTo(ProveedorModelo::class, 'id_proveedor', 'id_proveedor');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'id_compra', 'id_compra');
    }
}
