<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ModelUsuario\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\ModelUsuario\Propietario;
use App\Models\ModelUsuario\Transcriptor;
use Carbon\Carbon;
use App\Http\Requests\CSVRequests\CSVRequest;
use Illuminate\Support\LazyCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Middleware\IsAdmin;

use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $usuario;
    protected $transcriptor;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
        $this->usuario = new User;
        $this->transcriptor = new transcriptor;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'type_user' => ['required','in:Propietario,Ingeniero,Veterinario,Asistente'],
            'cellphone' => ['required','numeric','digits_between:10,15']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $tipoUser = $data['type_user'];

        /*
        echo "<pre>[";
        echo $tipoUser;
        echo "]<br>";
        print_r($data);
        echo "]<pre>";
        exit;
        */
        
        try{

            $tipoUser = $this->usuario->contienePalabra($data['type_user']);

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->type_user = $tipoUser;
            $user->image = $filename;

            if ($user->save()) {

                $id = $user->id;
                if($tipoUser == "Propietario") {
                    $propietarioData = [
                        'id' => $id,
                        'Nombre' => $data['name'],
                        'Apellido' => $data['lastname'],
                        'Telefono' => $data['cellphone'],
                        'Archivado' => false
                    ];
                    $propietario = propietario::create($propietarioData);

                    $data = [
                        'Propietario' => $propietario
                    ];

                    /*return response()->json([
                        'message'=>'Usuario propietario creado con exito',
                        'data'=>$data,
                        'status'=>'OK'
                    ],201);*/


                    return $user;

                } else {
                    $transcriptorData = [
                        'id' => $id,
                        'Nombre' => $data['name'],
                        'Apellido' => $data['lastname'],
                        'Telefono' => $data['cellphone'],
                        'Tipo_Transcriptor' => $tipoUser,
                        'Archivado' => false
                    ];
                    $transcriptor = transcriptor::create($transcriptorData);

                    $data = [
                        'Transcriptor' => $transcriptor
                    ];

                    /*return response()->json([
                        'message'=>'Usuario transcriptor creado con exito',
                        'data'=>$data,
                        'status'=>'OK'
                    ],201);*/

                    return $user;

                }

            } else {
                return response()->json([
                    'message'=>'Ha habido un problema al registrar el usuario. Intente de nuevo',
                    'data'=>[],
                    'code'=>'ERROR_REGISTRAR',
                    'status'=>'Erro'
                ],500);
            }

        }catch(\Exception $e){
            Log::error($e->getMessage());
                return response()->json([
                    'message'=>'Ha habido un fallo al crear el usuario. Intente de nuevo',
                    'data'=>[],
                    'status'=>'Error'
                ],500);
        }
    }

    protected function addUserMasivo(csvRequest $request)
    {
        try{
            $archivo = fopen($request->file('archivo')->getPathname(), 'r');

            if ($archivo === false) { //verifico si se abrio el archivo o no
                return response()->json([
                    'message' => 'No se pudo abrir el archivo CSV.',
                    'status' => 'ERROR'
                ], 500);
            }
            $archivoAbierto = true;

            LazyCollection::make(function () use ($archivo) {
              while ($fila = fgetcsv($archivo, 0, ';')) {
                  yield $fila;
              }
             })->chunk(100)->each(function ($chunk) use(&$erroresValidacion) {
                foreach ($chunk as $fila) {

                if ($fila[0] === 'id') {
                    continue; // Omitir la primera fila
                }
                    // Lógica para procesar cada fila
                    $id_personal = $fila[0];
                    $name = $fila[1];
                    $lastname = $fila[2];
                    $cellphone = $fila[3];
                    $email = $fila[4];
                    $password = Hash::make($fila[5]);
                    $type_user = $fila[6];

                    $datetime = now();

                    $lote_user = [
                      'name' => $name,
                      'email'=> $email,
                      'email_verified_at'=> $datetime,
                      'password'=> $password,
                      'created_at'=> $datetime,
                      'updated_at'=> $datetime,
                      'type_user'=> $type_user
                    ];

                    $validator = $this->validator([
                        'name' => $name,
                        'lastname'=> $lastname,
                        'cellphone'=> $cellphone,
                        'email'=> $email,
                        'password'=> $password,
                        'password_confirmation'=> $password,
                        'type_user'=> $type_user
                    ]); //realizo la validacion

                    if ($validator->fails()) {
                      $erroresValidacion[] = $validator->errors();
                      return false; // Detener el procesamiento de más filas
                  }

                   $ids_User = DB::table('users')->insertGetId($lote_user);

                   $lote_tipoUser = [
                    [
                    'id'=> $ids_User,
                    'id_Personal'=> $id_personal,
                    'Nombre' => $name,
                    'Apellido'=> $lastname,
                    'Telefono'=> $cellphone,
                    'archivado'=> false,
                    'created_at'=> $datetime,
                    'updated_at'=> $datetime,
                    'type_user'=> $type_user
                    ]
                   ];

                   $this->addTipoUserMasivo($lote_tipoUser);

              }

            });


            if ($archivoAbierto) {
                fclose($archivo);
            }

            if (!empty($erroresValidacion)) { //Avisa si hay un dato no valido
                return response()->json([
                    'message' => 'Se encontraron errores de validación.',
                    'status' => 'ERROR',
                    'errors' => $erroresValidacion
                ], 422);
            }

              return response()->json(['message'  => 'Datos procesados correctamente',
                                      'status'=>'OK'
      ],201);

            }catch(\Exception $e){
                Log::error($e->getMessage());
                return response()->json([
                    'message'=>'Ha habido un fallo al crear el usuario. Intente de nuevo',
                    'data'=>[],
                    'status'=>'Error'
                ],500);
            }
    }

    protected function addTipoUserMasivo(array $dataUsers)
    {
        try{

          $chunks = array_chunk($dataUsers, 100);

         foreach($chunks as $chunk){

          foreach($chunk as $data){
            if($data['type_user'] == "Propietario") {
                $propietarioData = [
                    'id' => $data['id'],
                    'id_Personal'=> $data['id_Personal'],
                    'Nombre' => $data['Nombre'],
                    'Apellido' => $data['Apellido'],
                    'Telefono' => $data['Telefono'],
                    'created_at'=>$data['created_at'],
                    'updated_at'=>$data['updated_at'],
                    'archivado' => false
                ];
                 DB::table('propietario')->insert($propietarioData);
                 Log::info("Propietario insertado: ", $propietarioData);

            } else {
                $transcriptorData = [
                    'id' => $data['id'],
                    'id_Personal'=> $data['id_Personal'],
                    'Tipo_Transcriptor'=> $data['type_user'],
                    'Nombre' => utf8_encode($data['Nombre']),
                    'Apellido' => utf8_encode($data['Apellido']),
                    'Telefono' => $data['Telefono'],
                    'created_at'=>$data['created_at'],
                    'updated_at'=>$data['updated_at'],
                    'archivado' => false
                ];
                DB::table('transcriptor')->insert($transcriptorData);
                Log::info("Transcriptor insertado: ", $transcriptorData);

            }
          }
         }

         unset($dataUsers);

        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'message'=>'Ha habido un fallo al crear el usuario. Intente de nuevo',
                'data'=>[],
                'status'=>'Error'
            ],500);
        }
    }

    public function store(Request $request)
    {

        $filename = "user.png";

        $tipoUser = $request->type_user;
       
        try{

            $tipoUser = $this->usuario->contienePalabra($request->type_user);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->type_user = $tipoUser;
            
            if($request->hasFile('image')){
                    
                $filename = $request->email;
                $extension = $request->file('image')->getClientOriginalExtension();
                    
                try {
                        
                    //$request->image->storeAs('images', $filename, 'public');
                        
                    //$filename = 'mi_imagen.jpg';
					//Storage::disk('public')->put($filename, $request->image);
                        
                    //$path = $request->file('image')->store(public_path().'/storage/images');
                    //$path = $request->file('image')->store('public/images');
                    //env('APP_URL').'/public/storage/app/public/images'
                    //storage_path('app/public')
                        
                    //$image = $request->file('image');
                    //Storage::disk('public_custom')->put('/'.$image->getClientOriginalName(), $image);
                        
                    //$nuevoNombre = 'imagen_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                    //$path = 'public/images/' . $nuevoNombre;
                    //Storage::disk('public')->put($path, $request->file('image'));

                    //$nuevoNombre = 'imagen_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                    //$rutaCompleta = '/srv/disk3/1885095/www/ganaderasoft.alfalatinacolombia.com/public/storage/images/' . $nuevoNombre;
                    //$rutaCompleta = public_path().'/'.$nuevoNombre;
                    //Storage::put($rutaCompleta, $request->file('image'));
                    //Storage::disk('public_custom')->put($nuevoNombre, $request->file('image'));
                        
                    $request->image->storeAs('images', $filename.'.'.$extension, 'public_custom');

					//return response()->json(['name' => $filename, 'ext' => $extension]);
                        
                    Log::info('Se supone almacenado...'.$filename.'.'.$extension);
                        
                } catch (\Exception $e) {
                    // Manejar el error, por ejemplo, mostrar un mensaje al usuario o registrar el error
                    Log::error('Error al subir el archivo: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Ocurrió un error al subir el archivo.');
                }
            }

            $user->image = $filename.'.'.$extension;

            if ($user->save()) {

                $id = $user->id;
                if($tipoUser == "Propietario") {
                    $propietarioData = [
                        'id' => $id,
                        'Nombre' => $request->name,
                        'Apellido' => $request->lastname,
                        'Telefono' => $request->cellphone,
                        'Archivado' => false
                    ];
                    $propietario = propietario::create($propietarioData);

                    $data = [
                        'Propietario' => $propietario
                    ];

                    /*return response()->json([
                        'message'=>'Usuario propietario creado con exito',
                        'data'=>$data,
                        'status'=>'OK'
                    ],201);*/


                    //return $user;
                    return redirect($this->redirectPath());

                } else {
                    $transcriptorData = [
                        'id' => $id,
                        'Nombre' => $request->name,
                        'Apellido' => $request->lastname,
                        'Telefono' => $request->cellphone,
                        'Tipo_Transcriptor' => $tipoUser,
                        'Archivado' => false
                    ];
                    $transcriptor = transcriptor::create($transcriptorData);

                    $data = [
                        'Transcriptor' => $transcriptor
                    ];

                    /*return response()->json([
                        'message'=>'Usuario transcriptor creado con exito',
                        'data'=>$data,
                        'status'=>'OK'
                    ],201);*/

                    //return $user;
                    return redirect($this->redirectPath());

                }

            } else {
                return response()->json([
                    'message'=>'Ha habido un problema al registrar el usuario. Intente de nuevo',
                    'data'=>[],
                    'code'=>'ERROR_REGISTRAR',
                    'status'=>'Erro'
                ],500);
            }

        }catch(\Exception $e){
            Log::error($e->getMessage());
                return response()->json([
                    'message'=>'Ha habido un fallo al crear el usuario. Intente de nuevo',
                    'data'=>[],
                    'status'=>'Error'
                ],500);
        }
    }

    public function createUsuario()
    {

        return view('usuario.crearusuario', [
        	'quien' => 'Her, soy yo, soy yo,...',
        ]);

    }

    public function editUsuario()
    {

        return view('usuario.modificarusuario', [
        	'quien' => 'Her, soy yo, soy yo,...',
        ]);

    }

    public function updateUsuario()
    {

        return view('usuario.consultarusuario', [
        	'quien' => 'Her, soy yo, soy yo,...',
        ]);

    }

    public function deleteUsuario()
    {

        return view('usuario.eliminarusuario', [
        	'quien' => 'Her, soy yo, soy yo,...',
        ]);

    }

    public function archivarUsuario()
    {

        return view('usuario.archivarusuario', [
        	'quien' => 'Her, soy yo, soy yo,...',
        ]);

    }

    public function seleccionarSubirUsuarios()
    {

        return view('usuario.seleccionarSubirUsuarios', [
        	'quien' => 'Her, soy yo, soy yo,...',
        ]);

    }

    public function crudUsuarios()
    {

        return view('usuario.welcome', [
        	'quien' => 'Her, soy yo, soy yo,...',
        ]);

    }

}
