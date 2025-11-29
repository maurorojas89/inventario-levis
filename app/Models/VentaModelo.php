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
        'estadoVenta',
        'totalVenta' // nuevo campo para el total general
    ];

    public function cliente()
    {
        return $this->belongsTo(ClienteModelo::class, 'id_cliente', 'id_cliente');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVentaModelo::class, 'id_venta', 'id_venta');
    }
}   