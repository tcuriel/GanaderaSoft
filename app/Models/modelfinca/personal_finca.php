<?php

namespace App\Models\modelfinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personal_finca extends Model
{
    use HasFactory;

    protected $table = "personal_finca";
    protected $primaryKey = "id_Tecnico";
    public $timestamps = true;

    protected $fillable = [
                           'id_Finca',
                           'Cedula',
                           'Nombre',
                           'Apellido',
                           'Telefono',
                           'Correo',
                           'Tipo_Trabajador'
                          ];

    public function finca(): BelongsTo
    {
        return $this->BelongsTo(finca::class,'id_Finca');
    }

    public function pesoCorporales(): HasMany
    {
        return $this->HasMany(peso_corporal::class, 'id_Tecnico');
    }
}
