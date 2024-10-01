<?php

namespace App\Models\ModelAnimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoSalud extends Model
{
    use HasFactory;

    protected $table = 'estado_salud';
    protected $primaryKey = 'estado_id';
    public $timestamps = false;

    protected $fillable = [
                 'estado_nombre'
                        ];
}
