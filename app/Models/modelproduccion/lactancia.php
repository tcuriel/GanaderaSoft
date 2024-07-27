<?php

namespace App\Models\modelproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lactancia extends Model
{
    use HasFactory;

    protected $table = "lactancia";
    protected $primaryKey = "id_Lactancia";

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function historicolactancias(): HasMany
    {
        return $this->HasMany(historico_lactancia::class, 'id_Lactancia');
    }
}
