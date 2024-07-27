<?php

namespace App\Models\modelfinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventario_bufalo extends Model
{
    use HasFactory;

    protected $table = "Inventario_Bufalo";
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
        return $this->BelongsTo(finca::class, 'id_Finca');
    }
}
