<?php

namespace App\Models\modelfinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movimiento_rebano extends Model
{
    use HasFactory;

    protected $table = "movimiento_rebano";
    protected $primaryKey = "id_Movimiento";

    protected $fillable = [
                         'id_Movimiento',
                         'id_Finca',
                         'id_Rebano',
                         'Rebano_Destino',
                         'id_Finca_Destino',
                         'id_Rebano_Destino',
                         'Comentario'
                         ];

    public function finca(): BelongsTo
    {
        return $this->BelongsTo(finca::class, 'id_Finca');
    }

    public function Rebanos(): BelongsTo
    {
        return $this->BelongsTo(rebano::class, 'id_Rebano');
    }

   public function animales(): BelongsToMany
   {
    return $this->BelongsToMany(animal::class, 'movimiento_rebano_animal', 'id_Movimiento', 'id_Animal',
                                                'id_Movimiento', 'id_Animal');
   }

   public function movimientoRebanosAnimales(): HasMany
   {
    return $this->HasMany(movimiento_rebano_animal::class, 'id_Movimiento', 'id_Animal',
                                                        'id_Movimiento', 'id_Animal');
   }

}
