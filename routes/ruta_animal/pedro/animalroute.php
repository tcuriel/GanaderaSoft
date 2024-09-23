<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\animalcontroller;

//Animal
Route::get('/animales/{id_rebano}',[animalcontroller::class,'getAnimals']);
Route::get('/tipos',[animalcontroller::class,'getTipoAnimal']);
Route::get('/etapas/{etapa_id}',[animalcontroller::class,'getEtapaAnimal']);
Route::get('/salud',[animalcontroller::class,'getSalud']);
Route::get('/rebano/{id_finca}',[animalcontroller::class,'getRebanos']);
Route::get('/razas/{id_finca}',[animalcontroller::class,'getRazas']);
Route::get('/detalle/{id_Animal}',[animalcontroller::class,'detailAnimal']);

Route::post('/agregar-animal',[animalcontroller::class,'agregarAnimal']);

Route::put('/modificar-animal/{idAnimal}',[animalcontroller::class,'modificarAnimal']);

Route::delete('/eliminar-animal/{idAnimal}',[animalcontroller::class,'eliminarAnimal']);

Route::put('/archivar-animal/{idAnimal}',[animalcontroller::class,'archivarAnimal']);

Route::get('/listar-animales/{idRebano}',[animalcontroller::class,'listarAnimales']);

Route::get('filtrar-animal/{tipo}/{idAnimal}/{idRebano}/{texto}',[animalcontroller::class,'filtrarAnimal']);

Route::get('/eventos/{idRebano}',[animalcontroller::class,'eventosGeneral']);

Route::get('/eventos-animal/{idAnimal}',[animalcontroller::class,'eventosAnimal']);
//Toro
//Agregar Toro
Route::post('/agregar-toro/{idRaza}/{idFinca}',[animalcontroller::class,'agregarToro']);
//Listar Toros
Route::get('/toros/{idFinca}',[animalcontroller::class,'listarToros']);

Route::get('/consulta-toro/{idToro}',[animalcontroller::class,'consultarToro']);

Route::get('/toro-filtro/{tipo}/{idFinca}/{texto}',[animalcontroller::class,'filtrarToro']);

Route::put('/modificar-toro/{idToro}',[animalcontroller::class,'modificarToro']);

Route::delete('/eliminar-toro/{idToro}',[animalcontroller::class,'eliminarToro']);

//Semen Toro
Route::post('/agregar-semen/{idToro}',[animalcontroller::class,'agregarSemen']);

Route::put('/estado-semen/{idSemen}',[animalcontroller::class,'modificarEstadoSemen']);


//csv
Route::post('/csv-agregar',[animalcontroller::class,'agregarMasivo']);