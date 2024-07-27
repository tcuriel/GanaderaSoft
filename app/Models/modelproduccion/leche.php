<?php

namespace App\Models\modelproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leche extends Model
{
    use HasFactory;

    protected $table = "leche";
    protected $primaryKey = "id_Pesaje";

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function historicoleches(): HasMany
    {
        return $this->HasMany(historico_Leche::class, 'id_Pesaje');
    }
}
