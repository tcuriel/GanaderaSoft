<?php

namespace App\Models\Modelanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenezDia extends Model
{
    use HasFactory;

    protected $table = 'prenez_dia';
    protected $primaryKey = 'prdi_id';
    public $timestamps = true;

    protected $fillable = [
                 'prdi_tamano',
                 'tamano',
                 'prdi_dia_id',
                 'prdi_palpacion_id'
                        ];
}
