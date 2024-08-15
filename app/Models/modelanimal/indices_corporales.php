<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AnimalRequests\indiceRequest;

class indices_corporales extends Model implements interfaceAnimal
{
    use HasFactory;

    protected $table = "indices_corporales";
    protected $primaryKey = "id_Indice";
    public $timestamps = true;

    protected $fillable = [
                    'id_Indice',
                    'Anamorfosis',
                    'Corporal',
                    'pelviano',
                    'Proporcionalidad',
                    'Dactilo_Toracico',
                    'Pelviano_Transversal',
                    'Pelviano_Longitudinal',
                    'indice_etapa_anid',
                    'indice_etapa_etid'
                        ];

     //verifica si ya existe un registro de este animal
     public function verificarRegistro($idAnimal){
        return DB::table('indices_corporales')->where('id_Animal',$idAnimal)->exists();
     }

     public function verificarModificacion(indiceRequest $data,$id_indice)
     {
         try{
             $existe = DB::table('indices_corporales')
             ->where('id_Indice',$id_indice)
             ->first();
         if (!$existe) {
            return true;
        }
        // Campos a comparar
    $campos = [
        'Anamorfosis',
        'Corporal',
        'pelviano',
        'Proporcionalidad',
        'Dactilo_Toracico',
        'Pelviano_Transversal',
        'Pelviano_Longitudinal'
    ];

    foreach ($campos as $campo) {
        if ($existe->$campo != $data['medida.' . $campo]) {
            // Alguno de los campos es diferente, se puede modificar
            return true;
        }
    }

    // Todos los campos son iguales, no se puede modificar
    return false;
         }catch(QueryException $e){
             return response()->json([
                 'message'=>'Ha habido un fallo en el sistema. Intnte de nuevo',
                 'data'=>[],
                 'code'=>'ERROR_QUERYEXCEPTION',
                 'status'=>'ERROR'
         ],500);
         }
     }

     public function verificarNulidad($data)
     {
        $campos = [
            'Anamorfosis',
            'Corporal',
            'pelviano',
            'Proporcionalidad',
            'Dactilo_Toracico',
            'Pelviano_Transversal',
            'Pelviano_Longitudinal'
        ];

       
        foreach ($campos as $campo) {
            if (isset($data[$campo]) && $data[$campo] !== null) {
                return true;
                
            }
        }

        return false;
     }


}
