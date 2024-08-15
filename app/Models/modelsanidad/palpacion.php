<?php

namespace App\Models\modelsanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class palpacion extends Model
{
    use HasFactory;

    protected $table = 'palpacion';
    protected $primaryKey = 'palpacion_id';
    public $timestamps = false;

    protected $fillable = [
                 'id_Tecnico',
                 'palpacion_tipo',
                 'palpacion_fecha',
                 'palpacion_etapa_anid',
                 'palpacion_etapa_etid'
                        ];
}
