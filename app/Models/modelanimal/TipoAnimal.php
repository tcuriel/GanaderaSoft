<?php

namespace App\Models\ModelAnimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAnimal extends Model
{
    use HasFactory;
    protected $table = 'tipo_animal';
    protected $primaryKey = "tipo_animal_id";
    public $timestamps = true;

    protected $fillable = [
                'tipo_animal_id',
                'tipo_animal_nombre'
    ];

    
}
