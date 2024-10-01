<?php

namespace App\Models\ModelFinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Afiliacion extends Model
{
    use HasFactory;
    protected $table = "afiliacion";
    protected $primaryKey = ["id_Personal_P" , "id_Personal_T"];
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
                          'id_Personal_P',
                          'id_Personal_T',
                          'id_Finca',
                          'Estado',
                          'receptor_solicitud'
                          ];

    public function fincas(): BelongsTo
    {
        return $this->BelongsTo(Finca::class, "id_Finca", "id_Finca");
    }

    public function transcriptores(): BelongsTo
    {
        return $this->BelongsTo(transcriptor::class, "id_Personal_T", "id");
    }

    public function propietarios(): BelongsTo
    {
        return $this->BelongsTo(propietario::class, "id_Personal_P", "id");
    }

    public function existeAfiliacion($id_P,$id_T)
    {
        $buscar = DB::table('afiliacion')->whereRaw('id_Personal_P =? and id_Personal_T=?',[$id_P,$id_T])->first();
    
        if($buscar==null){
            return  false;
        }else{
            return true;
        }
    }

    public function buscarAfiliacion($id_P,$id_T,$idFinca)
    {
        try{
            return Afiliacion::where('id_Personal_P',$id_P)->where('id_Personal_T',$id_T)
                            ->where('id_Finca',$idFinca)->firstOrFail();

        }catch(QueryException $e){
            return response()->json([
                'message'=>'Ha habido un fallo al cambiar el estado de la afiliacion, intente de nuevo',
                'data'=>[],
                'code'=>'ERROR_QUERYEXCEPTION',
                'status'=>'Error'
            ],500);
        }
       
    }

    public function obtenerEstadoAfiliacion($id_P,$id_T,$idFinca)
    {
        try{
            return Afiliacion::where('id_Personal_P',$id_P)->where('id_Personal_T',$id_T)
                            ->where('id_Finca',$idFinca)->value('Estado');

        }catch(QueryException $e){
            return response()->json([
                'message'=>'Ha habido un fallo al cambiar el estado de la afiliacion, intente de nuevo',
                'data'=>[],
                'code'=>'ERROR_QUERYEXCEPTION',
                'status'=>'Error'
            ],500);
        }
    }

    public function cambiarEstadoAfiliacion($estado,$idPropietario,$idTranscriptor,$idFinca)
    {
      try{
          DB::table('afiliacion')->where('id_Personal_P',$idPropietario)->where('id_Personal_T',$idTranscriptor)
                                 ->where('id_Finca',$idFinca)->update(['Estado' => $estado]);
        //------------------------------------------------------------------------
        return DB::table('afiliacion')->where('id_Personal_P',$idPropietario)->where('id_Personal_T',$idTranscriptor)
                                      ->where('id_Finca',$idFinca)->first();
    
    }catch(QueryException $e){
        return response()->json([
            'message'=>'Ha habido un fallo al cambiar el estado de la afiliacion, intente de nuevo',
            'data'=>[],
            'code'=>'ERROR_QUERYEXCEPTION',
            'status'=>'Error'
        ],500);
      }
    }

}
