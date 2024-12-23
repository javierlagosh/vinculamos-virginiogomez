<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SedesActividades extends Model
{
    use HasFactory;

    protected $table = 'sedes_actividades';

    public $timestamps = false;

    protected $fillable = [
        'sede_codigo',
        'acti_codigo',
        'seac_creado',
        'seac_actualizado',
        'seac_nickname_mod',
        'seac_rol_mod'
    ];
}
