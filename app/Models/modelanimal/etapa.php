<?php

namespace App\Models\ModelAnimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    use HasFactory;

    protected $table = 'etapa';
    protected $primaryKey = 'etapa_id';
    public $timestamps = true;

    protected $fillable = [
                'etapa_id',
                'etapa_nombre',
                'etapa_edad_ini',
                'etapa_edad_fin',
                'etapa_fk_tipo_animal_id'
    ];
}
