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
                    'Fecha_Peso',
                    'Peso',
                    'Comentario',
                    'peso_etapa_anid',
                    'peso_etapa_etid'
                        ];

    //verifica si ya existe un registro de este animal
     public function verificarRegistro($idAnimal){
        return DB::table('peso_corporal')->where('id_Animal',$idAnimal)->exists();
     }
}
