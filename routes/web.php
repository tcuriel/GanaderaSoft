<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('splash');
})->name('splash');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/acerca_de', function () {
    return view('acerca_de');
})->name('acerca_de');

Auth::routes();

//Route::get('/registrar', [UserController::class, 'create'])->middleware('isAdmin');
//Route::get('/crearusuario', [App\Http\Controllers\Auth\RegisterController::class, 'crearUsuario'])->name('crearusuario');
/*Route::middleware(['auth', 'admin'])->get('/crearusuario', [App\Http\Controllers\Auth\RegisterController::class, 'crearUsuario'])->name('crearusuario');
Route::get('/modificarusuario', [App\Http\Controllers\Auth\RegisterController::class, 'modificarUsuario'])->name('modificarusuario');
Route::get('/consultarusuario', [App\Http\Controllers\Auth\RegisterController::class, 'consultarUsuario'])->name('consultarusuario');
Route::get('/eliminarusuario', [App\Http\Controllers\Auth\RegisterController::class, 'eliminarUsuario'])->name('eliminarusuario');
Route::get('/archivarusuario', [App\Http\Controllers\Auth\RegisterController::class, 'archivarUsuario'])->name('archivarusuario');
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/crearusuario', [App\Http\Controllers\Auth\RegisterController::class, 'createUsuario'])->name('crearusuario');
    Route::get('/editarusuario', [App\Http\Controllers\Auth\RegisterController::class, 'editUsuario'])->name('editarusuario');
    Route::put('/actualizarusuario', [App\Http\Controllers\Auth\RegisterController::class, 'updateUsuario'])->name('actualizarusuario');
    // ... y así sucesivamente para todas las rutas que deban usar estos middleware
});

Route::get('/finca/pdf', [App\Http\Controllers\FincaController::class, 'pdf'])->name('finca.pdf');

Route::get('/crudusuarios/{opcion}/{archivado}', [App\Http\Controllers\PrincipalController::class, 'crudUsuarios'])->name('crudusuarios.option.list');
//Route::get('/listado/{opcion}/{archivado}',[PrincipalController::class,'userOptionList'])->name('users.option.list');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/splash_finca', [App\Http\Controllers\HomeController::class, 'splashFinca'])->name('frontpagefinca');
Route::get('/crearfinca', [App\Http\Controllers\HomeController::class, 'createmyfarm'])->name('createmyfarm');
Route::get('/crearmifinca', [App\Http\Controllers\HomeController::class, 'createmyfarm'])->name('createmyfarmI');

Route::get('/dashboard/{section}/{view}/{id_finca}', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/dashboard/finca/rebano/agregar/{id_finca}', [App\Http\Controllers\HomeController::class, 'agregarRebano'])->name('agregarRebano');
Route::get('/dashboard/finca/personal/agregar/{id_finca}', [App\Http\Controllers\HomeController::class, 'agregarPersonal'])->name('agregarPersonal');
Route::get('/dashboard/finca/inventario/agregar/{id_finca}', [App\Http\Controllers\HomeController::class, 'agregarInventario'])->name('agregarInventario');
Route::get('/finca/animal/agregar/{id_finca}', [App\Http\Controllers\HomeController::class, 'crearanimal'])->name('crearanimal');

Route::post('/crear_finca', [App\Http\Controllers\ActionPostController::class, 'create_farm'])->name('create_farm');

/* --- */
Route::post('/storeregister', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('storeregister');

Route::post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');
//Route::get('/emailsent', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');

Route::get('/emailsent', function () {
    return view('auth.passwords.emailSent', []); // Add semicolon here
})->name('password.emailsent');

//Route::get('/seleccionar',[SubirUsuarioController::class,'seleccionarArvhivo'])->name('seleccionar');
Route::get('/seleccionar',[App\Http\Controllers\User\SubirUsuarioController::class,'seleccionarArchivo'])->name('seleccionar');
Route::get('/seleccionarSubirUsuarios',[App\Http\Controllers\User\SubirUsuarioController::class,'seleccionarSubirUsuarios'])->name('seleccionarSubirUsuarios');

Route::get('/finca/rebano/{id_finca}/up/{id_rebano}', [App\Http\Controllers\HomeController::class, 'upRebano'])->name('upRebano');
//Route::get('/propietario', [App\Http\Controllers\PropietarioController::class, 'index'])->name('propietario');
Route::resource('finca', App\Http\Controllers\FincaController::class);

Route::get('/homeImage',[App\Http\Controllers\HomeController::class, 'photo'])->name('homeImage');
Route::post('/upload', [App\Http\Controllers\HomeController::class, 'upload'])->name('upload');

Route::post('/crear_finca', [App\Http\Controllers\ActionPostController::class, 'create_farm'])->name('create_farm');

// reproduccion
route::get('/agregarReproduccion/{id_Animal}',[App\Http\Controllers\HomeController::class,'crearReproduccion']);
route::get('/agregar/celo/{id_Animal}',[App\Http\Controllers\HomeController::class,'crearCelo']);
// sanidad
route::get('/getsanidad/{id_Rebano}',[App\Http\Controllers\HomeController::class,'verSanidad']);

Route::get('/animal/{id}', [App\Http\Controllers\HomeController::class, 'detalleAnimal']);

Route::get('/medidas',[App\Http\Controllers\HomeController::class,'medidas']);

Route::get('/animal/modificar/{id_animal}',[App\Http\Controllers\HomeController::class,'modificarAnimal']);

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});

/*
Route::get('/auth/google/callback', function () {
    try {
        $user = Socialite::driver('google')->user();
        // Process the authenticated user data
    } catch (Exception $e) {
        return redirect('/login');
    }
});
*/

// GoogleLoginController redirect and callback urls
Route::get('/login/google', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback']);
//Route::get('/login/google/callback',  'SocialiteAuthController@loginWithGoogle');
/*
Route::get('/tablero', function () {
    return view('layouts.pageFinal');
});
*/