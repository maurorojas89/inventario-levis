<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    use HasFactory;

    // Nombre de la tabla en la BD
    protected $table = 'herramienta';

    // Clave primaria
    protected $primaryKey = 'id_herramienta';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'fecha_ingreso',
    ];

    // Si no usas timestamps en esta tabla
    public $timestamps = false;
}
