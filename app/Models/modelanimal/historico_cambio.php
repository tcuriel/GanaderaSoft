<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historico_cambio extends Model
{
    use HasFactory;

    protected $table = "historico_cambio";
    protected $primaryKey = "id_Historico";
    public $timestamps = true;

    protected $fillable = [
                    'id_Historico',
                    'id_Cambio',
                    'id_Animal',
                    'Fecha_Cambio',
                    'Etapa_Cambio',
                    'Peso',
                    'Altura',
                    'Comentario',
                    'Fecha_Actualizacion'
           ];

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function cambiosA(): BelongsTo
    {
        return $this->BelongsTo(cambios_animal::class, 'id_Cambio');
    }
}
