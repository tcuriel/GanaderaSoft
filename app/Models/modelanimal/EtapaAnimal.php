<?php

namespace App\Models\ModelAnimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtapaAnimal extends Model
{
    use HasFactory;

    protected $table = 'etapa_animal';
    protected $primaryKey = ["etan_etapa_id","etan_animal_id"];
    public $timestamps = false;

    protected $fillable = [
                'etan_etapa_id',
                'etan_animal_id',
                'etan_fecha_ini',
                'etan_fecha_fin'
    ];
}
