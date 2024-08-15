<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class composicion_raza extends Model
{
    use HasFactory;
    protected $table = 'composicion_raza';
    protected $primaryKey = 'id_Composicion';
    public $timestamps = true;

    protected $fillable = [
                    'id_Composicion',
                    'Nombre',
                    'Siglas',
                    'Pelaje',
                    'Proposito',
                    'Tipo_Raza',
                    'Origen',
                    'Caracteristica_Especial',
                    'Proporcion_Raza',
                    'fk_id_finca',
                    'fk_tipo_animal_id'
                        ];

    public function verificarNombre($tipoVerificar,$nombre,$idFinca,$id_Composicion=null)
    {
      try{
       if($tipoVerificar=='Agregar'){
        $verNombre = DB::table('composicion_raza')->select('composicion_raza.Nombre')
                ->where('composicion_raza.Nombre',$nombre)
                ->join('Tipo_Raza', 'Tipo_Raza.id_Composicion', '=', 'composicion_raza.id_Composicion')
                ->where('composicion_raza.Mixta', 0)
                ->orWhere('Tipo_Raza.id_Finca', $idFinca)
                ->get();

       }elseif($tipoVerificar=='Modificar'){
        $verNombre = DB::table('composicion_raza')->select('composicion_raza.Nombre')
        ->whereRaw('composicion_raza.id_Composicion != ?', [$id_Composicion])
        ->join('Tipo_Raza', 'Tipo_Raza.id_Composicion', '=', 'composicion_raza.id_Composicion')
        ->where(function ($query) use ($idFinca) {
          $query->where('composicion_raza.Mixta', 0)
                ->orWhere('Tipo_Raza.id_Finca', $idFinca);
        })
                ->get();

        }

        $existe = false;
        foreach($verNombre as $nombreA){
           if($nombreA->Nombre===$nombre){
            
             return $existe = true;
             
              break;
           }
        }
        return $existe;

      }catch(\Exception $e){
        return response()->json([
            'message' => 'Ha habido un fallo en el sistema. Intente de nuevo',
            'data' => [],
            'status' => 'Error'
        ],500);
      }
    }

    public function verificarRegistro($id_Composicion){
      try{
      $verEstado = DB::table('composicion_raza')
          ->select('Mixta')
          ->where('id_Composicion',$id_Composicion)
          ->where('Mixta',0)
          ->first();

          if($verEstado===null){
            return false;
           }
    }catch(\Exception $e){
      return response()->json([
        'message' => 'Ha habido un fallo en el sistema. Intente de nuevo',
        'data' => [],
        'status' => 'Error'
    ],500);
    }
        return true;
    }

    public function verificarRaza($id){
      try{
      $verificar = DB::table('composicion_raza')
                ->where('id_Composicion',$id)
                ->exists();

      return $verificar;

      }catch(QueryException $e){
        return response()->json([
          'message' => 'Ha habido un fallo en el sistema. Intente de nuevo',
          'data' => [],
          'status' => 'Error'
      ],500);
      }
    }
}
