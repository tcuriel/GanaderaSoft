<?php

namespace App\Models\modelreproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historico_reproduccionA extends Model
{
    use HasFactory;

    protected $table = "historico_reproduccionA";
    protected $primaryKey = "id_HistoricoRA";

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function reproduccionesA(): BelongsTo
    {
        return $this->BelongsTo(reproduccion_animal::class, 'id_ReproduccionA');
    }
}
