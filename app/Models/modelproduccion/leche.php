<?php

namespace App\Models\ModelProduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leche extends Model
{
    use HasFactory;

    protected $table = "leche";
    protected $primaryKey = 'leche_id';

   protected $fillable = [
                'leche_fecha_pesaje',
                'leche_pesaje_total',
                'leche_lactancia_id'
   ];
}
