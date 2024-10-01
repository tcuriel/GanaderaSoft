<?php

namespace App\Models\ModelAnimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AnimalRequests\MedidasRequest;

class MedidasCorporales extends Model implements InterfaceAnimal
{
    use HasFactory;

    protected $table = "medidas_corporales";
    protected $primaryKey = "id_Medida";
    public $timestamps = true;

    protected $fillable = [
                    'id_Medida',
                    'Altura_HC',
                    'Altura_HG',
                    'Perimetro_PT',
                    'Perimetro_PCA',
                    'Longitud_LC',
                    'Longitud_LG',
                    'Anchura_AG',
                    'medida_etapa_anid',
                    'medida_etapa_etid'
                    ];

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(Animal::class, 'id_Animal');
    }

    public function historicoMedidaCor(): HasMany
    {
        return $this->HasMany(historico_medidascor::class, 'id_Medida');
    }

    protected static function booted()
    {
        static::deleting(function (MedidasCorporales $medida) {
            
            $medida->historicoMedidaCor()->delete();
        });
    }

     //verifica si ya existe un registro de este animal
     public function verificarRegistro($idAnimal){
        return DB::table('medidas_corporales')->where('id_Animal',$idAnimal)->exists();
     }

     public function verificarModificacion(MedidasRequest $data,$id_Medida)
     {
         try{
             $existe = DB::table('medidas_corporales')
             ->where('id_Medida',$id_Medida)
             ->first();
         if (!$existe) {
            return true;
        }
        // Campos a comparar
    $campos = [
        'Altura_HC',
        'Altura_HG',
        'Perimetro_PT',
        'Perimetro_PCA',
        'Longitud_LC',
        'Longitud_LG',
        'Anchura_AG',
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
            'Altura_HC',
            'Altura_HG',
            'Perimetro_PT',
            'Perimetro_PCA',
            'Longitud_LC',
            'Longitud_LG',
            'Anchura_AG',
        ];

       
        foreach ($campos as $campo) {
            if (isset($data[$campo]) && $data[$campo] !== null) {
                return true;
                
            }
        }

        return false;
     }
}
