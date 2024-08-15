<?php

namespace App\Models\modelsanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ovario extends Model
{
    use HasFactory;

    protected $table = 'ovario';
    protected $primaryKey = 'ovario_id';
    public $timestamps = true;

    protected $fillable = [
                    'ovario_medida',
                    'ovario_tamano',
                    'ovario_lado',
                    'ovario_palpacion_id'
                        ];
}
