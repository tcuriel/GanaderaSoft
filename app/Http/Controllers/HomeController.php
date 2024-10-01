<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Config\Repository;
use App\Http\Controllers\FincaController;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $config;

    /**
     * @var FincaController
     */
    private $fincaController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        FincaController $fincaController,
        Repository $config
    ){
        $this->middleware('auth');
        $this->middleware('verified.user.finca', ['except' => ['splashFinca','createmyfarm']]);
        $this->fincaController = $fincaController;
        $this->config = $config;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $statusFarms = config('app.statusfarm');
        $fincas = $this->fincaController->fincasPropietario($user->id,0)->getData();
        
        if($user->type_user == 'Administrar')
        {
            $aDonde = 'administrar.welcome';
            //echo $aDonde;
            //exit;
        }else if($user->type_user == 'Propietario')
        {
            $aDonde = 'finca.welcome';
        }else
        {
            $aDonde = 'welcome';
        }

        return view($aDonde, [
        	'user' => $user,
            'statusFarms' => $statusFarms,
            'farms' => $fincas->data
        ]);
    }

    public function dashboard(string $section, string $view, int $id_finca) {

        $controllerSection = $this->config->get('app.section.' . $section);
        if (is_null($controllerSection)) {
            abort(404);
        }
        $controllerView = $this->config->get('app.'.$controllerSection.'-selector-view.' . $view);
        if (is_null($controllerView)) {
            abort(404);
        }
        /***ES FINCA HAY QUE SEPARAR POR CLASES PARA ALS ORAS SESCCIONES***/
        $data = $this->fincaController->getFarm($id_finca)->getData()->data;
        if (count($data) < 1) {
            abort(404);
        }
        $methods = config('app.metodo-riego');
        $phs = config('app.ph-suelo');
        $reliefes = config('app.relieve-suelo');
        $textures = config('app.textura-suelo');
        $fontaines = config('app.fuente-agua');
        $exploitations = config('app.explotacion');
        $rutaOrigen = "welcome";
        $selectorViews = config('app.finca-selector-view');
        $statusFarms = config('app.statusfarm');
        $personalRequests = config('app.solicitudes');
        $inventarioRequests = config('app.inventario');
        /*
        echo 'section-'.$section;
        echo 'selectView-'.$view;
        echo 'selectorViews-';
        dd($selectorViews);
        */
        //exit;

        $listRebano = $this->fincaController->listarRebano("Activo",$data[0]->id_Finca)->getData()->data;
        return view('home', [
            'user' => Auth::user(),
            'section' => $section,
            'selectorViews' => $selectorViews,
            'selectView' => $view,
            'statusFarms' => $statusFarms,
            'personalRequests' => $personalRequests,
            'inventarioRequests' => $inventarioRequests,
            'data' => $data,
            'methods' => $methods,
            'phs' => $phs,
            'reliefes' => $reliefes,
            'textures' => $textures,
            'fontaines' => $fontaines,
            'exploitations' => $exploitations,
            'rutaOrigen' => $rutaOrigen,
            'listRebano' => $listRebano// separar para animal
        ]);
        /***ES FINCA HAY QUE SEPARAR POR CLASES PARA ALS ORAS SESCCIONES***/

    }

    public function  splashFinca()
    {
        return view('finca.frontpagefinca', [
            'user' => Auth::user()
        ]);
    }

    public function  createmyfarm(Request $request)
    {
        $methods = config('app.metodo-riego');
        $phs = config('app.ph-suelo');
        $reliefes = config('app.relieve-suelo');
        $textures = config('app.textura-suelo');
        $fontaines = config('app.fuente-agua');
        $exploitations = config('app.explotacion');
        $rutaOrigen = $request->route()->getName();

        switch($rutaOrigen) {
            case 'createmyfarm':
                $rutaOrigen = 'frontpagefinca';
            break;
            case 'createmyfarmI':
                $rutaOrigen = 'home';
            break;
            default:
                $rutaOrigen = 'frontpagefinca';
            break;
        }

        return view('finca.createmyfarm', [
            'user' => Auth::user(),
            'methods' => $methods,
            'phs' => $phs,
            'reliefes' => $reliefes,
            'textures' => $textures,
            'fontaines' => $fontaines,
            'exploitations' => $exploitations,
            'rutaOrigen' => $rutaOrigen
        ]);
    }

    public function agregarRebano(int $id_finca) {

        $data = $this->fincaController->getFarm($id_finca)->getData()->data;
        if (count($data) < 1) {
            abort(404);
        }

        $selectorViews = config('app.finca-selector-view');
        return view('finca.agregarrebano', [
            'user' => Auth::user(),
            'section' => 'finca',
            'selectView' => 'rebano',
            'selectorViews' => $selectorViews,
            'data' => $data,
        ]);
    }
    
    public function agregarPersonal(int $id_finca) {

        $data = $this->fincaController->getFarm($id_finca)->getData()->data;
        if (count($data) < 1) {
            abort(404);
        }

        $selectorViews = config('app.finca-selector-view');
        return view('finca.agregarpersonal', [
            'user' => Auth::user(),
            'section' => 'finca',
            'selectView' => 'personal',
            'selectorViews' => $selectorViews,
            'data' => $data,
        ]);
    }
    
    public function agregarInventario(int $id_finca) {

        $data = $this->fincaController->getFarm($id_finca)->getData()->data;
        if (count($data) < 1) {
            abort(404);
        }

        $inventories = config('app.inventario-selector');

        $selectorViews = config('app.finca-selector-view');
        return view('finca.agregarinventario', [
            'user' => Auth::user(),
            'section' => 'finca',
            'selectView' => 'personal',
            'selectorViews' => $selectorViews,
            'data' => $data,
            'inventories' => $inventories
        ]);
    }

    public function crearanimal (int $id_finca) {

        $data = $this->fincaController->getFarm($id_finca)->getData()->data;
        if (count($data) < 1) {
            abort(404);
        }

        $animalSexo = config('app.animal-sexo');
        $animalState = config('app.animal-state');
        $animalType = config('app.animal-type');
        $animalStage = config('app.animal-stage');
        $listRebano = $this->fincaController->listarRebano("Activo",$data[0]->id_Finca)->getData()->data;

        return view('animal.createanimal', [
            'user' => Auth::user(),
            'data' => $data,
            'animalSexo' => $animalSexo,
            'animalState' => $animalState,
            'animalType' => $animalType,
            'animalStage' => $animalStage,
            'listRebano' => $listRebano
        ]);
    }


    public function upRebano(int $id_finca, int $id_rebano) {

        $datafinca = $this->fincaController->getFarm($id_finca)->getData()->data;
        if (count($datafinca) < 1) {
            abort(404);
        }

        $datarebano = $this->fincaController->getRebano($id_rebano)->getData()->data;
        if (empty($datarebano)) {
            abort(404);
        }

        return view('animal.uprebano', [
            'user' => Auth::user(),
            'data' => $datafinca,
            'selectorHerd' => $id_rebano,
            'datarebano' => $datarebano
        ]);
    }

    public function  photo(Request $request)
    {
        return view('homeImage');
    }
    
    public function upload(Request $request)
    {

        echo "<pre>Her, soy yo..[";
        print_r($request->image->getClientOriginalName());
        echo "]<pre>";
        exit;

        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images',$filename,'public');
            Auth()->user()->update(['image'=>$filename]);
        }
        return redirect()->back();
    }
    
    public function crearReproduccion($id_Animal){
        return view('reproduccion.createreproduccion',[
                    'user'=> Auth::user(),
                    'data'=> $id_Animal
        ]);
    }

    public function crearCelo($id_Animal){
        return view('reproduccion.createcelo',[
            'user'=> Auth::user(),
            'data'=> $id_Animal
		]);
    }

    public function verSanidad($id_Animal){
        return view('sanidad.getsanidad',[
                    'user'=> Auth::user(),
                    'data'=> $id_Animal
        ]);
    }

    public function detalleAnimal(int $id_Animal){
        $animal = DB::table('animal')->where('id_Animal',$id_Animal)->first();
        return response()->json($animal);
    }

    public function medidas(){
        return view('animal.medidas',[
            'user' => Auth::user(),
           
        ]);
    }

    public function modificarAnimal($id_Animal){
        return view('animal.modificaranimal',[
            'user' => Auth::user(),
        ]);
    }

}
