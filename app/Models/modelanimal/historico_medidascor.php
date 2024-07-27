<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historico_medidascor extends Model
{
    use HasFactory;

    protected $table = "historico_medidascor";
    protected $primaryKey = "id_Historico";
    public $timestamps = true;

    protected $fillable = [
        'id_Historico',
        'id_Medida',
        'id_Animal',
        'Altura_HC',
        'Altura_HG',
        'Perimetro_PT',
        'Perimetro_PCA',
        'Longitud_LC',
        'Longitud_LG',
        'Anchura_AG',
        'Fecha_Actualizacion'
        ];


    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function MedidasCor(): BelongsTo
    {
        return $this->BelongsTo(medidas_corporales::class, 'id_Medida');
    }
}
