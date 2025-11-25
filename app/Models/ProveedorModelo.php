<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProveedorModelo extends Model
{
    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';
    protected $fillable = [
    'nombreProveedor',
    'empresa',
    'rolProveedor',
    'telefonoProveedor',
    'correoProveedor',
    'direccion'
];
}
