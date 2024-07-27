<?php

namespace App\Models\modelreproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reproduccion_animal extends Model
{
    use HasFactory;

    protected $table = "reproduccion_animal";
    protected $primaryKey = "id_ReproduccionA";

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function historicoReproduccionA(): HasMany
    {
        return $this->HasMany(historico_reproduccionA::class, 'id_ReproduccionA');
    }
}
