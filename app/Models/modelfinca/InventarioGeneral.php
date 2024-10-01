<?php

namespace App\Models\ModelFinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioGeneral extends Model
{
    use HasFactory;

    protected $table = "inventario_general";
    protected $primaryKey = "id_Inv";
    public $timestamps = true;

    protected $fillable = [
                        'id_Finca',
                        'Num_Personal',
                        'Fecha_Inventario'
                          ];

    public function finca(): BelongsTo
    {
        return $this->BelongsTo(Finca::class, 'id_Finca');
    }
}
