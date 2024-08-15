<?php

namespace App\Models\modelreproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicio_animal extends Model
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
