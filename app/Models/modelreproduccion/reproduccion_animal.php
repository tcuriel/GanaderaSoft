<?php

namespace App\Models\modelreproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reproduccion_animal extends Model
{
    use HasFactory;

    protected $table = "reproduccion_animal";
    protected $primaryKey = "repro_id";

  protected $fillable = [
            'repro_fecha_reproduccion',
            'repro_tipo_reproduccion',
            'repro_observacion',
            'repro_servicio_id'
  ];
}
