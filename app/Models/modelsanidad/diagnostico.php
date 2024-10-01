<?php

namespace App\Models\ModelSanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    protected $table = 'diagnostico';
    protected $primaryKey = 'diagnostico_id';
    public $timestamps = true;

    protected $fillable = [
              'diagnostico_descripcion',
              'diagnostico_tipo',
              'diagnostico_fecha',
              'fk_etapa_animal_anid',
              'fk_etapa_animal_etid'
    ];
}
