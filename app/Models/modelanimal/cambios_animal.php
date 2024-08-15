<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AnimalRequests\cambioRequest;


class cambios_animal extends Model
{
    use HasFactory;

    protected $table = "cambios_animal";
    protected $primaryKey = "id_Cambio";
    public $timestamps = true;

    protected $fillable = [
                     'id_Cambio',
                     'id_Animal',
                     'Fecha_Cambio',
                     'Etapa_Cambio',
                     'Peso',
                     'Altura',
                     'Comentario',
                     'cambios_etapa_anid',
                     'cambios_etapa_etid'
                        ];

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function historicoCambiosA(): HasMany
    {
        return $this->HasMany(historico_cambio::class, 'id_Cambio');
    }

    protected static function booted()
    {
        static::deleting(function (cambios_animal $ca) {
            
            $ca->historicoCambiosA()->delete();
        });
    }

    //verifica si el cambio esta permitido segun la edad y el tipo de cambio del animal
    public function verificarCambio($id,$nuevaEdad)
    {
     try{
         $animal = DB::table('animal')
                     ->join('cambios_animal', 'cambios_animal.id_Animal','=','animal.id_Animal')
                    ->select('animal.Etapa','cambios_animal.Etapa_Cambio')
                    ->where('animal.id_Animal',$id)->first();
 
                    if ($animal) {
                        $etapaCambio = $animal->Etapa_Cambio;
            
                        switch ($etapaCambio) {
                            case 'Becerra':
                                $minEdad = 0;
                                $maxEdad = 12;
                                $mensaje = 'Para el cambio a becerra(o) la edad debe estar entre 0 y 12 meses';
                                break;
                            case 'Maute':
                                $minEdad = 12;
                                $maxEdad = 24;
                                $mensaje = 'Para el cambio a Mauta(e) la edad debe estar entre 12 y 24 meses';
                                break;
                            case 'Novilla':
                                $minEdad = 24;
                                $maxEdad = 30;
                                $mensaje = 'Para el cambio a novilla(o) la edad debe estar entre 24 y 30 meses';
                                break;
                            case 'Vaca':
                                $minEdad = 24;
                                $mensaje = 'Para el cambio a vaca o toro la edad debe ser mínimo 24 meses';
                                break;
                            default:
                                return true; // Si no hay restricciones específicas, permitimos el cambio
                        }
            
                        if ($nuevaEdad < $minEdad || ($maxEdad && $nuevaEdad > $maxEdad)) {
                            return $this->enviarRespuesta($mensaje, $animal, 'OK', 200);
                        } else {
                            return true;
                        }
                    } else {
                        return $this->enviarRespuesta('No existe informacicon del animal',[],'OK',200);
                    }
 
        
 
     }catch(QueryException $e){
         return response()->json([
             'message'=>'Ha habido un fallo en el sistema. Intente de nuevo',
             'data'=>[],
             'code'=>'ERROR_QUERYEXCEPTION',
             'status'=>'ERROR'
     ],500);
     }
    }

    //verifica si ya existe un registro de este animal
    public function verificarRegistro($idAnimal){
       return DB::table('cambios_animal')->where('id_Animal',$idAnimal)->exists();
    }

    public function verificarModificacion(cambioRequest $data,$id_Cambio)
    {
        try{
            $registro = DB::table('cambios_animal')
            ->where('id_Cambio',$id_Cambio)
            ->first();
        if ($registro) {
    
        if ($registro->Fecha_Cambio == $data['cambio.Fecha_Cambio'] &&
            $registro->Etapa_Cambio == $data['cambio.Etapa_Cambio'] &&
            $registro->Peso == $data['cambio.Peso'] &&
            $registro->Altura == $data['cambio.Altura'] &&
            $registro->Comentario == $data['cambio.Comentario']) {
// todos los campos son iguales, no se puede modificar
            return false;
            } else {
        // alguno de los campos es diferente, se puede modificar
            return true;
            }
            } else {
            // el registro no existe, se puede crear
            return true;
            }

        }catch(QueryException $e){
            return response()->json([
                'message'=>'Ha habido un fallo en el sistema. Intnte de nuevo',
                'data'=>[],
                'code'=>'ERROR_QUERYEXCEPTION',
                'status'=>'ERROR'
        ],500);
        }
    }


   private function enviarRespuesta($mensaje,$datos,$estado,$codigoRetorno)
   {
   return response()->json([
       'message' => $mensaje,
       'data' => $datos,
       'status' => $estado
   ], $codigoRetorno);
   }
}
