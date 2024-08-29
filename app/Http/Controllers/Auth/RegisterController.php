<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\modelusuario\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\modelusuario\propietario;
use App\Models\modelusuario\transcriptor;
use Carbon\Carbon;
use App\Http\Requests\csvRequests\csvRequest;
use Illuminate\Support\LazyCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

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
        $this->middleware('guest');
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
        //$tipoUser = $data['type_user'];

        try{

            $tipoUser = $this->usuario->contienePalabra($data['type_user']);

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->type_user = $tipoUser;

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
                 DB::table('Propietario')->insert($propietarioData);
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
                DB::table('Transcriptor')->insert($transcriptorData);
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
        echo "Her, soy yo, soy yo,...";
        echo "<pre>";
        //dd($data);
        //$request = $data['request'];
        //$name = $request->request->get('name');
        //$file = $request->files->get('image');
        //$originalName = $file->getClientOriginalName();
        //print_r($file->getClientOriginalName());
        //print_r($request->all());
        //print_r($data['request']->name);
        //print_r($data['files']->originalName);
        echo "</pre>";
        //exit;

        $this->create((array) $request);

        $this->validator($request->all())->validate();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // Aquí puedes agregar campos personalizados a tu modelo de usuario

        $user->save();

        // ... resto del código para enviar correo de bienvenida, etc.

        return redirect($this->redirectPath());
    }


    public function crearUsuario()
    {

        return view('auth.crearusuario', [
        	'quien' => 'Her, soy yo, soy yo,...',
        ]);

    }

    public function modificarUsuario()
    {

        return view('auth.modificarusuario', [
        	'quien' => 'Her, soy yo, soy yo,...',
        ]);

    }

    public function consultarUsuario()
    {

        return view('auth.consultarusuario', [
        	'quien' => 'Her, soy yo, soy yo,...',
        ]);

    }

    public function eliminarUsuario()
    {

        return view('auth.eliminarusuario', [
        	'quien' => 'Her, soy yo, soy yo,...',
        ]);

    }

    public function archivarUsuario()
    {

        return view('auth.archivarusuario', [
        	'quien' => 'Her, soy yo, soy yo,...',
        ]);

    }


}
