<?php

namespace App\Models\modelsanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tratamiento extends Model
{
    use HasFactory;

    protected $table = 'tratamiento';
    protected $primaryKey = 'tratamiento_id';
    public $timestamps = true;

    protected $fillable = [
                 'tratamiento_plan',
                 'tratamiento_fecha_ini',
                 'tratamiento_fecha_fin',
                 'tratamiento_diagnostico_id'
                        ];
}
