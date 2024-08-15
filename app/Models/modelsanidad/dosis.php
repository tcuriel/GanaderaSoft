<?php

namespace App\Models\modelsanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dosis extends Model
{
    use HasFactory;

    
    protected $table = 'dosis';
    protected $primaryKey = 'dosis_id';
    public $timestamps = true;

    protected $fillable = [
              'dosis_cantidad',
              'dosis_costo',
              'dosis_costo_frasco',
              'dosis_fecha_uso_ini',
              'dosis_fecha_uso_fin',
              'fk_vacuna_id'
    ];
}
