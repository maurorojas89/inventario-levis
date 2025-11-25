<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompraModelo extends Model
{
    protected $table = 'compra';
    protected $primaryKey = 'id_compra';
    protected $fillable = [
        'id_proveedor',
        'fechaCompra',
        'estadoCompra',
        'totalCompra'
    ];

    public function proveedor()
    {
        return $this->belongsTo(ProveedorModelo::class, 'id_proveedor', 'id_proveedor');
    }
    public function detalles()
{
    return $this->hasMany(DetalleCompra::class, 'id_compra');
}

}
