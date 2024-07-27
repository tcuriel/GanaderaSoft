<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AnimalRequests\pesoRequest;


class registro_pesocor extends Model
{
    use HasFactory;

    protected $table = "registro_pesocor";
    protected $primaryKey = "id_Registro";
    public $timestamps = true;

    protected $fillable = [
        'id_Registro',
        'id_Peso',
        'id_Animal',
        'id_Tecnico',
        'Peso_Nacer',
        'Fecha_Nacer',
        'Peso_Destete',
        'Fecha_Destete',
        'Peso_Actual',
        'Comentario',
        'Fecha_Actual',
        'created_at',
        'update_at'
            ];

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function pesoCorporales(): BelongsTo
    {
        return $this->BelongsTo(peso_corporal::class, 'id_Peso');
    }

    public function comprobarHistorico($data,$idPeso,$tipo)
    {
        $historico = DB::table('registro_pesocor')
                            ->where('id_Peso',$idPeso)->latest()->first();

        $columna_fecha = 'Fecha_' . $tipo;
        $columna_peso = 'Peso_' . $tipo;

                            $datosHistorico = [
                                'id_Peso' => $idPeso,
                                'id_Animal' => $historico->id_Animal,
                                'id_Tecnico' => $historico->id_Tecnico,
                                'Peso_Nacer' => $historico->Peso_Nacer,
                                'Peso_Destete' => $historico->Peso_Destete,
                                'Peso_Actual' => $historico->Peso_Actual,
                                'Fecha_Nacer' => $historico->Fecha_Nacer,
                                'Fecha_Destete' => $historico->Fecha_Destete,
                                'Fecha_Actual' => $historico->Fecha_Actual,
                                $columna_fecha => $data[$columna_fecha],
                                $columna_peso => $data[$columna_peso],
                                'Comentario' => $data['Comentario'],
                            ];
            
                            // Asegurarse de que los nuevos datos sobrescriban los antiguos si están presentes
                            if ($tipo === 'Nacer') {
                                $datosHistorico['Peso_Nacer'] =$data[$columna_peso];
                                $datosHistorico['Fecha_Nacer'] = $data[$columna_fecha];
                            } elseif ($tipo === 'Destete') {
                                $datosHistorico['Peso_Destete'] =$data[$columna_peso];
                                $datosHistorico['Fecha_Destete'] = $data[$columna_fecha];
                            } elseif ($tipo === 'Actual') {
                                $datosHistorico['Peso_Actual'] =$data[$columna_peso];
                                $datosHistorico['Fecha_Actual'] = $data[$columna_fecha];
                            }

            return $datosHistorico;
    }

    public function verificarModificacion(pesoRequest $data,$id_Peso,$tipo)
     {
         try{
             $existe = DB::table('registro_pesocor')
             ->where('id_Peso',$id_Peso)
             ->latest()
             ->first();
         if (!$existe) {
            return true;
        }
        // Campos a comparar

    $fechaPeso = $data['peso']['Fecha_Peso'];
    $peso = $data['peso']['Peso'];

    $campos = [
        'Nacer',
        'Destete',
        'Actual',
    ];

    $columna_fecha = 'Fecha_' . $tipo;
    $columna_peso = 'Peso_' . $tipo;


    if ($existe->$columna_fecha != $data['peso']['Fecha_Peso'] ||
       $existe->$columna_peso != $data['peso']['Peso']){
         return true;
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
}
