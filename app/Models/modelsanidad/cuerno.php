<?php

namespace App\Models\modelsanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuerno extends Model
{
    use HasFactory;

    protected $table = 'cuerno';
    protected $primaryKey = 'id_Cuernos';
    public $timestamps = true;

    protected $fillable = [
                'fk_palpacion_id',
                'cuerno_tamano',
                'cuerno_medicion',
                'cuerno_lado',
                'cuerno_fk_estado_sano',
                'cuerno_fk_iu_id'
                ];
}
