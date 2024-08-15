<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etapa extends Model
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
