<?php

namespace App\Models\ModelFinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioBufalo extends Model
{
    use HasFactory;

    protected $table = "inventario_bufalo";
    protected $primaryKey = "id_Inv_B";
    public $timestamps = true;

    protected $fillable = [
                        'id_Finca',
                        'Num_Becerro',
                        'Num_Anojo',
                        'Num_Bubilla',
                        'Num_Bufalo',
                        'Fecha_Inventario'
                        ];

    public function finca(): BelongsTo
    {
        return $this->BelongsTo(Finca::class, 'id_Finca');
    }
}
