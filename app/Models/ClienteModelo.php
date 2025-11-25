<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteModelo extends Model
{
    protected $table = 'cliente';

    // Clave primaria basada en id_cliente (autoincremental)
    protected $primaryKey = 'id_cliente';
    public $incrementing = true;
    protected $keyType = 'int';

    // Laravel usará created_at y updated_at (ya las agregaste en la BD)
    public $timestamps = false;

    protected $fillable = [
        'documentoCliente',
        'tipoDocumentoCliente',
        'nombreCliente',
        'apellidoCliente',
        'direccionCliente',
        'telefonoCliente',
        'emailCliente',
    ];
}
