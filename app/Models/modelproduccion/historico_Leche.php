<?php

namespace App\Models\modelproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historico_Leche extends Model
{
    use HasFactory;

    protected $table = "historico_leche";
    protected $primaryKey = "id_Historico";

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function leches(): BelongsTo
    {
        return $this->BelongsTo(leche::class, 'id_Pesaje');
    }
}
