<?php

namespace App\Models\ModelReproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReproduccionAnimal extends Model
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
