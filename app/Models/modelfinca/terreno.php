<?php

namespace App\Models\ModelFinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terreno extends Model
{
    use HasFactory;

    protected $table = "terreno";
    protected $primaryKey = "id_Terreno";
    public $timestamps = true;

    protected $fillable = ['id_Finca','Superficie','Relieve','Suelo_Textura','ph_Suelo','Precipitacion',
                          'Velocidad_Viento','Temp_Anual','Temp_Min','Temp_Max','Radiacion',
                           'Fuente_Agua','Caudal_Disponible','Riego_Metodo'];

    public function finca(): BelongsTo
    {
        return $this->BelongsTo(Finca::class, 'id_Finca');
    }
}
