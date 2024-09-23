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

Route::get('/finca/rebano/{id_finca}/up/{id_rebano}', [App\Http\Controllers\HomeController::class, 'upRebano'])->name('upRebano');

Route::post('/crear_finca', [App\Http\Controllers\ActionPostController::class, 'create_farm'])->name('create_farm');

// reproduccion
route::get('/agregarReproduccion/{id_Animal}',[App\Http\Controllers\HomeController::class,'crearReproduccion']);
route::get('/agregar/celo/{id_Animal}',[App\Http\Controllers\HomeController::class,'crearCelo']);
// sanidad
route::get('/getsanidad/{id_Rebano}',[App\Http\Controllers\HomeController::class,'verSanidad']);

Route::get('/animal/{id}', [App\Http\Controllers\HomeController::class, 'detalleAnimal']);

Route::get('/medidas',[App\Http\Controllers\HomeController::class,'medidas']);

Route::get('/animal/modificar/{id_animal}',[App\Http\Controllers\HomeController::class,'modificarAnimal']);
