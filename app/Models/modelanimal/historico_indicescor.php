<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historico_indicescor extends Model
{
    use HasFactory;

    protected $table = "historico_indicescor";
    protected $primaryKey = "id_Historico";
    public $timestamps = true;

    protected $fillable = [
        'id_Historico',
        'id_Indice',
        'id_Animal',
        'Anamorfosis',
        'Corporal',
        'pelviano',
        'Proporcionalidad',
        'Dactilo_Toracico',
        'Pelviano_Transversal',
        'Pelviano_Longitudinal',
        'Fecha_Actualizacion'
            ];

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function IndicesCor(): BelongsTo
    {
        return $this->BelongsTo(indices_corporales::class, 'id_Indice');
    }
}
