<?php

namespace App\Models\modelproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lactancia extends Model
{
    use HasFactory;

    protected $table = "lactancia";
    protected $primaryKey = 'lactancia_id';

    protected $fillable = [
                'lactancia_fecha_inicio',
                'lactancia_fecha_fin',
                'lactancia_secado',
                'lactancia_repro_id'
    ];
}
