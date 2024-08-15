<?php

namespace App\Models\modelsanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class involucion_uterina extends Model
{
    use HasFactory;

    protected $table = 'involucion_uterina';
    protected $primaryKey = 'iu_id';
    public $timestamps = true;

    protected $fillable = [
                    'iu_plano',
                    'iu_descripcion'
                        ];
}
