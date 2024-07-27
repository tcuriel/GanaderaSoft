<?php

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
    return view('splash2');
})->name('splash2');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

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
Route::get('/seleccionar',[App\Http\Controllers\User\SubirUsuarioController::class,'seleccionarArvhivo'])->name('seleccionar');

Route::get('/finca/rebano/{id_finca}/up/{id_rebano}', [App\Http\Controllers\HomeController::class, 'upRebano'])->name('upRebano');
//Route::get('/propietario', [App\Http\Controllers\PropietarioController::class, 'index'])->name('propietario');
Route::resource('finca', App\Http\Controllers\FincaController::class);
Route::get('/homeImage',[App\Http\Controllers\HomeController::class, 'photo'])->name('homeImage');
Route::post('/upload', [App\Http\Controllers\HomeController::class, 'upload'])->name('upload');