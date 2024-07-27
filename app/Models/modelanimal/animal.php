<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\modelfinca\movimiento_rebano_animal;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class animal extends Model
{
    use HasFactory;

    protected $table = "Animal";
    protected $primaryKey = "id_Animal";

    protected $fillable = [
                        'id_Animal',
                        'id_Finca',
                        'id_Rebano',
                        'Nombre',
                        'Sexo',
                        'Edad',
                        'Tipo',
                        'Etapa',
                        'Estado',
                        'Procedencia',
                        'archivado'
                        ];

    public function finca(): BelongsTo
    {
        return $this->BelongsTo(finca::class, 'id_Finca');
    }

    public function reproduccionAnimales(): HasMany
    {
        return $this->HasMany(reproduccion_animal::class, 'id_Animal');
    }

    public function historicoReproduccionAnimales(): HasMany
    {
        return $this->HasMany(historico_repdroduccionA::class, 'id_Animal');
    }

    public function leches(): HasMany
    {
        return $this->HasMany(leche::class, 'id_Animal');
    }

    public function historicoLeches(): HasMany
    {
        return $this->HasMany(historico_leche::class, 'id_Animal');
    }

    public function lactancias(): HasMany
    {
        return $this->HasMany(lactancia::class, 'id_Animal');
    }

    public function historicoLactancias(): HasMany
    {
        return $this->HasMany(historico_lactancia::class, 'id_Animal');
    }

    public function razas(): HasOne
    {
        return $this->HasOne(raza_animal::class, 'id_Animal');
    }

    public function arbolesGeneticos(): HasOne
    {
        return $this->HasOne(arbol_genetica::class, 'id_Animal');
    }

    public function cambiosAnimales(): HasOne
    {
        return $this->HasOne(cambios_animal::class, 'id_Animal');
    }

    public function historicoCambiosA(): HasMany
    {
        return $this->HasMany(historico_cambio::class, 'id_Animal');
    }


    public function medidasCorporales(): HasOne
    {
        return $this->HasOne(medidas_corporales::class, 'id_Animal');
    }

    public function historicoMedidasCor(): HasMany
    {
        return $this->HasMany(historico_medidascor::class, 'id_Animal');
    }


    public function indicesCorporales(): HasOne
    {
        return $this->HasOne(indices_corporales::class, 'id_Animal');
    }

    public function historicoIndicesCor(): HasMany
    {
        return $this->HasMany(historico_indicescor::class, 'id_Animal');
    }


    public function pesosCorporales(): HasOne
    {
        return $this->HasOne(peso_corporal::class, 'id_Animal');
    }

    public function registroPesoCor(): HasMany
    {
        return $this->HasMany(registro_pesocor::class, 'id_Animal');
    }

   public function movimientoRebanosAnimales(): HasMany
   {
    return $this->HasMany(movimiento_rebano_animal::class, 'id_Movimiento', 'id_Animal',
                                                           'id_Movimiento', 'id_Animal');
   }

   public function rebanos(): BelongsTo
   {
       return  $this->BelongsTo(rebano::class, 'id_Rebano');
    }

    protected static function booted()
    {
        static::deleting(function (animal $animal) {
            
            $animal->razas()->delete();
            $animal->arbolesGeneticos()->delete();
            $animal->historicoCambiosA()->delete();
            $animal->cambiosAnimales()->delete();
           $animal->historicoMedidasCor()->delete();
            $animal->medidasCorporales()->delete();
            $animal->historicoIndicesCor()->delete();
            $animal->indicesCorporales()->delete();
            $animal->registroPesoCor()->delete();
            $animal->pesosCorporales()->delete();
           
            $animal->movimientoRebanosAnimales()->delete();

        });
    } 

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
