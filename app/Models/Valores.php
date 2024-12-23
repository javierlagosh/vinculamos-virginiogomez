<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valores extends Model
{
    use HasFactory;

    protected $table = 'valores'; // Nombre de la tabla en la base de datos

    public $timestamps = false;

    protected $primaryKey = 'val_codigo'; // Clave primaria de la tabla

    protected $fillable = [
        'val_codigo',
        'val_nombre',
        'val_creado',
        'val_actualizado',
        'val_visible',
    ];

    protected $attributes = [
        'val_visible' => 1, // Valor predeterminado para val_visible
    ];
}                                                               
