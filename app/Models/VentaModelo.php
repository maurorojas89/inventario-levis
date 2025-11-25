<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaModelo extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    protected $fillable = [
        'id_cliente',
        'fechaVenta',
        'estadoVenta'
    ];

    public function cliente()
    {
        return $this->belongsTo(ClienteModelo::class, 'id_cliente', 'id_cliente');
    }
}
