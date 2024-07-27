<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class peso_corporal extends Model
{
    use HasFactory;

    protected $table = "peso_corporal";
    protected $primaryKey = "id_Peso";
    public $timestamps = true;

    protected $fillable = [
                    'id_Peso',
                    'id_Animal',
                    'id_Tecnico',
                    'Fecha_Peso',
                    'Peso',
                    'Comentario'
                        ];

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function registroPesoCor(): HasMany
    {
        return $this->HasMany(registro_pesocor::class, 'id_Peso');
    }

    public function personalFinca(): BelongsTo
    {
        return $this->BelongsTo(personal_finca::class, 'id_Tecnico');
    }

    //verifica si ya existe un registro de este animal
     public function verificarRegistro($idAnimal){
        return DB::table('peso_corporal')->where('id_Animal',$idAnimal)->exists();
     }
}
