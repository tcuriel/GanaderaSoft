<?php

namespace App\Models\ModelFinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoRebano extends Model
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
        return $this->BelongsTo(Finca::class, 'id_Finca');
    }

    public function Rebanos(): BelongsTo
    {
        return $this->BelongsTo(Rebano::class, 'id_Rebano');
    }

   public function animales(): BelongsToMany
   {
    return $this->BelongsToMany(Animal::class, 'movimiento_rebano_animal', 'id_Movimiento', 'id_Animal',
                                                'id_Movimiento', 'id_Animal');
   }

   public function movimientoRebanosAnimales(): HasMany
   {
    return $this->HasMany(MovimientoRebaAnimal::class, 'id_Movimiento', 'id_Animal',
                                                        'id_Movimiento', 'id_Animal');
   }

}
