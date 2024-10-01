<?php

namespace App\Models\ModelFinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalFinca extends Model
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
        return $this->BelongsTo(Finca::class,'id_Finca');
    }

    public function pesoCorporales(): HasMany
    {
        return $this->HasMany(PesoCorporal::class, 'id_Tecnico');
    }
}
