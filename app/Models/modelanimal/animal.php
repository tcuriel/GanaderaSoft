<?php

namespace App\Models\ModelAnimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModelFinca\MovimientoRebanoAnimal;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class Animal extends Model
{
    use HasFactory;

    protected $table = "animal";
    protected $primaryKey = "id_Animal";

    protected $fillable = [
                        'id_Animal',
                        'id_Rebano',
                        'Nombre',
                        'codigo_animal',
                        'Sexo',
                        'fecha_nacimiento',
                        'Procedencia',
                        'archivado',
                        'fk_composicion_raza'
                        ];

    public function arbolesGeneticos(): HasOne
    {
        return $this->HasOne(ArbolGenetica::class, 'id_Animal');
    }

   public function movimientoRebanosAnimales(): HasMany
   {
    return $this->HasMany(MovimientoRebanoAnimal::class, 'id_Movimiento', 'id_Animal',
                                                           'id_Movimiento', 'id_Animal');
   }

   public function rebanos(): BelongsTo
   {
       return  $this->BelongsTo(Rebano::class, 'id_Rebano');
    }

  /*  protected static function booted()
    {
        static::deleting(function (animal $animal) {
            
            $animal->razas()->delete();
            $animal->arbolesGeneticos()->delete();
          
            $animal->cambiosAnimales()->delete();
         
            $animal->medidasCorporales()->delete();
            $animal->historicoIndicesCor()->delete();
            $animal->indicesCorporales()->delete();
            $animal->registroPesoCor()->delete();
            $animal->pesosCorporales()->delete();
           
            $animal->movimientoRebanosAnimales()->delete();

        });
    }  */

   public function verificarTipo($id)
   {
     try{
        return DB::table('animal')->select('Tipo')->where('id_Animal',$id);
     }catch(QueryException $e){
        return response()->json([
                'message'=>'Ha habido un fallo en el sistema. Intnte de nuevo',
                'data'=>[],
                'code'=>'ERROR_QUERYEXCEPTION',
                'status'=>'ERROR'
        ],500);
     }
   }

   public function verificarEtapa($etapa,$edad,$tipo)
   {
    $rangosEdad = [
        'Vacuno' => [
        'Becerro' => [0,12],//MACHOS
        'Maute' => [12,24],
        'Novillo' => [24,30],
        'Toro' => [24, null],
        'Becerra' => [0, 12], //HEMBRAS
        'Mauta' => [12, 24],
        'Novilla' => [24, 30],
        'Vaca' => [24, null], // null indica que no hay límite superior
        ],
        //BUFALA
        'Bufala' =>[
        'Bucerro' => [0,12], //MACHOS
        'Añojo' => [12,18],
        'Butorete' => [18,24],
        'Butoro' => [24,null],
        'Bucerra' => [0,12], //HEMBRAS
        'Añoja' => [12,18],
        'Bubilla' => [18,30],
        'Bufala' =>[24,null],
        ]
    ];

    if (isset($rangosEdad[$tipo][$etapa])) {
        [$minEdad, $maxEdad] = $rangosEdad[$tipo][$etapa];
        // Verifica si la edad está dentro del rango permitido para la etapa
        if ($edad >= $minEdad && ($maxEdad === null || $edad <= $maxEdad)) {
            return true;
        }
    }
    return false;
    
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
