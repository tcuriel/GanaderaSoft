<?php

namespace App\Models\modelproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leche extends Model
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
