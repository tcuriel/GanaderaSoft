<?php

namespace App\Models\modelfinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventario_vacuno extends Model
{
    use HasFactory;

    protected $table = "Inventario_Vacuno";
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
        return $this->BelongsTo(finca::class, 'id_Finca');
    }
}
