<?php

namespace App\Models\modelsanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dia_palpacion extends Model
{
    use HasFactory;

    protected $table = 'dia_palpacion';
    protected $primaryKey = 'dia_id';
    public $timestamps = false;

    protected $fillable = [
                 'dia_dias'
                        ];
}
