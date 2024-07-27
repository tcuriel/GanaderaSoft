<?php

namespace App\Models\modelproduccion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historico_lactancia extends Model
{
    use HasFactory;

    protected $table = "historico_lactancia";
    protected $primaryKey = "id_Historico";

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function lactancias(): BelongsTo
    {
        return $this->BelongsTo(historico_lactancia::class, 'id_Lactancia');
    }
}
