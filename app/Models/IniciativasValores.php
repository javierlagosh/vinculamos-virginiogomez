<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasValores extends Model
{
    use HasFactory;
    protected $table = 'iniciativas_valores';

    public $timestamps = false;
    protected $primaryKey ='inival_codigo';

    protected $fillable = [
        'inival_codigo',
        'inival_valor',
        'inival_iniciativa',
        'inival_creado',
        'inival_actualizado'
    ];
}
