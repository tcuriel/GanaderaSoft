<?php

namespace App\Models\ModelReproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroCelo extends Model
{
    use HasFactory;

    protected $table = 'registro_celo';
    protected $primaryKey = 'celo_id';
    public $timestamps = false;

    protected $fillable = [
                 'celo_fecha',
                 'celo_observacion',
                 'celo_etapa_anid',
                 'celo_etapa_etid'
                        ];
}
