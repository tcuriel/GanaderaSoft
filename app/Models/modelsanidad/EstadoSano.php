<?php

namespace App\Models\ModelSanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoSano extends Model
{
    use HasFactory;

    
    protected $table = 'estado_sano';
    protected $primaryKey = 'essa_id';
    public $timestamps = true;

    protected $fillable = [
              'essa_estado'
    ];
}
