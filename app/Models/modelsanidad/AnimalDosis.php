<?php

namespace App\Models\ModelSanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalDosis extends Model
{
    use HasFactory;

    
    protected $table = 'animal_dosis';
    protected $primaryKey = 'ando_id';
    public $timestamps = false;

    protected $fillable = [
              'ando_fecha_apl',
              'ando_fk_dosis_id',
              'ando_fk_etapa_animal_anid',
              'ando_fk_etapa_animal_etid'
    ];
}
