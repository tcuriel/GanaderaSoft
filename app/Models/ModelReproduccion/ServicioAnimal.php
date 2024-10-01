<?php

namespace App\Models\ModelReproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioAnimal extends Model
{
    use HasFactory;

    protected $table = 'servicio_animal';
    protected $primaryKey = 'servicio_id';
    public $timestamps = true;

    protected $fillable = [
                 'servicio_id_Animal',
                 'servicio_semen_id',
                 'servicio_id_Tecnico',
                 'servicio_tipo',
                 'servicio_fecha',
                 'servicio_observacion',
                 'servicio_celo_id'
                        ];
}
