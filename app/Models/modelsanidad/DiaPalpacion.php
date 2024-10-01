<?php

namespace App\Models\ModelSanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaPalpacion extends Model
{
    use HasFactory;

    protected $table = 'dia_palpacion';
    protected $primaryKey = 'dia_id';
    public $timestamps = false;

    protected $fillable = [
                 'dia_dias'
                        ];
}
