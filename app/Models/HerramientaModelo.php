<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HerramientaModelo extends Model
{
    protected $table = 'herramienta';
    protected $primaryKey = 'id_herramienta';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'nombre', 'descripcion', 'cantidad', 'unidad'
    ];
}
