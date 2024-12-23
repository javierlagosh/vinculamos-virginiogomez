<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadesEvidencias extends Model
{
    use HasFactory;

    protected $table = 'actividades_evidencias'; // Nombre de la tabla en la base de datos
    public $timestamps = false;
    protected $primaryKey = 'actevi_codigo'; // Clave primaria de la tabla

    protected $fillable = [
        'actevi_codigo',
        'acti_codigo',
        'actevi_nombre',
        'actevi_ruta',
        'actevi_mime',
        'actevi_creado',
        'actevi_actualizado',
        'actevi_visible',
        'actevi_nickname_mod',
        'actevi_rol_mod',
    ];

    protected $attributes = [
        'acti_visible' => 1, // Valor predeterminado para acti_visible
    ];
}
