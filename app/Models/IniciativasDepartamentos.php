<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasDepartamentos extends Model
{
    use HasFactory;
    protected $table = 'iniciativas_departamentos';

    public $timestamps = false;
    protected $primaryKey ='inidep_codigo';

    protected $fillable = [
        'inidep_codigo',
        'inidep_departamento',
        'inidep_iniciativa',
        'inidep_creado',
        'inidep_actualizado'
    ];
}
