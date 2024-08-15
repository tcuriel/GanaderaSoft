<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\Validator;

use App\Models\modelreproduccion\registro_celo;
use App\Models\modelreproduccion\reproduccion_animal;
use App\Models\modelreproduccion\servicio_animal;
use App\Http\Requests\reproduccionRequests\reproduccionRequest;

/**
 * Class ReproduccionController
 * @package App\Http\Controllers
 */

class reproduccioncontroller extends Controller
{

    public function postRegistrarServicio(reproduccionRequest $request){
      $dataServicio = $request->validated();

     // Depuración
    \Log::info('Datos recibidos', $dataServicio);
      try{
        DB::transaction(function() use ($dataServicio, &$result){
          $result = DB::table('servicio_animal')->insert([
              'servicio_id_Animal' => $dataServicio['servicio_id_Animal'],
              'servicio_semen_id' => $dataServicio['servicio_semen_id'],
              'servicio_tipo' => $dataServicio['servicio_tipo'],
              'servicio_fecha' => $dataServicio['servicio_fecha'],
              'servicio_observacion' => $dataServicio['servicio_observacion'],
              'servicio_celo_id' => $dataServicio['servicio_celo_id']
          ]);

          
        });

        if(!$result){
          return response()->json([
              'message'=> 'Error en los campos',
              'data'=> [],
              'status'=>'Bad Request'
          ],400);
        }
        return response()->json([
          'message'=> 'EL servicio ha sido creada con exito,',
          'data'=>$result,
          'status'=>'OK'
        ],201);
      }catch(\Exception $e){
        Log::error($e->getMessage());

        // Devuelve la respuesta JSON con el mensaje de error
        return response()->json([
            'message' => 'Ha habido un fallo al ejecutar la accion. Intente de nuevo',
            'data' => [],
            'status' => 'Error'
        ], 500);
          }
    }

    public function getReproduccion(int $id_rebano, $selectView){
        try{
           switch($selectView){
             case 'animal':
                    $servicios = DB::table('animal')->where('id_Rebano',$id_rebano)
                                        ->select('animal.*')->get();
                break;

            case 'celo':
             /*   $servicios = DB::table('registro_celo')
                            ->join('animal')*/
                $servicios = DB::table('servicio_animal')
                ->join('animal', 'animal.id_Animal','=','servicio_animal.servicio_id_Animal')
                ->where('animal.id_Rebano',$id_rebano)
                ->select('animal.*','servicio_animal.*')
                ->get();
                break;

            case 'reproduccion':

                break;

            default:
           }
            
            return response()->json([
                'message' => 'servicios',
                'data' => $servicios,
                'status' => 'OK'
            ], 200);

        }catch(\Exception $e){
            return $this->manejarExcepcion($e);
          }
    }

    public function getDataFormServicio(int $id_Animal){
        try{
            $dataCelo = DB::table('animal')->join('registro_celo', 'registro_celo.celo_etapa_anid','=','animal.id_Animal')
                                          ->where('animal.id_Animal',$id_Animal)
                                          ->get();
                                      
            if($dataCelo->isEmpty()){
              return response()->json([
                'message' => 'servicios',
                'data' => [],
                'status' => 'OK'
            ], 200);
            }

                                          return response()->json([
                                            'message' => 'servicios',
                                            'data' => $dataCelo,
                                            'status' => 'OK'
                                        ], 200);
        }catch(\Exception $e){
            return $this->manejarExcepcion($e);
          }
    }

    public function getDataPadrote(int $id_Animal){
      try{
          $dataPadrote = DB::table('Padrote')->join('Rebano','Rebano.id_Rebano','=','Padrote.id_Rebano')
                                            ->join('Animal','Rebano.id_Rebano','=','animal.id_Rebano')
                                            ->where('animal.id_Animal',$id_Animal)
                                            ->select('Padrote.*')
                                            ->get();

        return response()->json([
          'message' => 'padrote',
          'data' => $dataPadrote,
          'status' => 'OK'
      ], 200);
      }catch(\Exception $e){
            return $this->manejarExcepcion($e);
          }
    }

    public function getdataSemen(int $id_Toro){
      try{
          $dataSemen = DB::table('semen_toro')->where('id_Toro',$id_Toro)->get();

          if($dataSemen->isEmpty()){
            return response()->json([
              'message' => 'semen',
              'data' => [],
              'status' => 'OK'
          ], 200);
          }

        return response()->json([
          'message' => 'semen',
          'data' => $dataSemen,
          'status' => 'OK'
      ], 200);
      }catch(\Exception $e){
            return $this->manejarExcepcion($e);
          }
    }
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reproduccions = Reproduccion::paginate();

        return view('reproduccion.index', compact('reproduccions'))
            ->with('i', (request()->input('page', 1) - 1) * $reproduccions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reproduccion = new Reproduccion();
        return view('reproduccion.create', compact('reproduccion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReproduccionRequest $request)
    {
        Reproduccion::create($request->validated());

        return redirect()->route('reproduccions.index')
            ->with('success', 'Reproduccion created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reproduccion = Reproduccion::find($id);

        return view('reproduccion.show', compact('reproduccion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reproduccion = Reproduccion::find($id);

        return view('reproduccion.edit', compact('reproduccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReproduccionRequest $request, Reproduccion $reproduccion)
    {
        $reproduccion->update($request->validated());

        return redirect()->route('reproduccions.index')
            ->with('success', 'Reproduccion updated successfully');
    }

    public function destroy($id)
    {
        Reproduccion::find($id)->delete();

        return redirect()->route('reproduccions.index')
            ->with('success', 'Reproduccion deleted successfully');
    }


    private function manejarExcepcion($excepcion)
{
    // Registra el error en el log
    Log::error($excepcion->getMessage());

    // Devuelve la respuesta JSON con el mensaje de error
    return response()->json([
        'message' => 'Ha habido un fallo al ejecutar la accion. Intente de nuevo',
        'data' => [],
        'status' => 'Error'
    ], 500);
}


}
