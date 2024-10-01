<?php

namespace App\Models\ModelSanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvolucionUterina extends Model
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
