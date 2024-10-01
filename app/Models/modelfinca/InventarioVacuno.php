<?php

namespace App\Models\ModelFinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioVacuno extends Model
{
    use HasFactory;

    protected $table = "inventario_vacuno";
    protected $primaryKey = "id_Inv_V";
    public $timestamps = true;

    protected $fillable = [
        'id_Finca',
        'Num_Becerra',
        'Num_Mauta',
        'Num_Novilla',
        'Num_Vaca', 
        'Num_Becerro',
        'Num_Maute',
        'Num_Torete', 
        'Num_Toro',
        'Fecha_Inventario',
                          ];

    public function finca(): BelongsTo
    {
        return $this->BelongsTo(Finca::class, 'id_Finca');
    }
}
