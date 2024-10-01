<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

//Animal
Route::get('/animales/{id_rebano}',[AnimalController::class,'getAnimals']);
Route::get('/animales-archivo/{id_rebano}',[AnimalController::class,'getAnimalsArchivado']);
Route::get('/tipos',[AnimalController::class,'getTipoAnimal']);
Route::get('/etapas/{etapa_id}',[AnimalController::class,'getEtapaAnimal']);
Route::get('/salud',[AnimalController::class,'getSalud']);
Route::get('/rebano/{id_finca}',[AnimalController::class,'getRebanos']);
Route::get('/razas/{id_finca}',[AnimalController::class,'getRazas']);
Route::get('/detalle/{id_Animal}',[AnimalController::class,'detailAnimal']);
Route::get('/finca-id/{id_animal}',[AnimalController::class,'getFincaID']);

Route::post('/agregar-animal',[AnimalController::class,'agregarAnimal']);

Route::put('/modificar-animal/{id_animal}',[AnimalController::class,'modificarAnimal']);

Route::delete('/eliminar-animal/{idAnimal}',[AnimalController::class,'eliminarAnimal']);

Route::put('/archivar-animal/{idAnimal}',[AnimalController::class,'archivarAnimal']);
Route::Put('/activar-animal/{idAnimal}',[AnimalController::class,'activarAnimal']);

Route::get('/listar-animales/{idRebano}',[AnimalController::class,'listarAnimales']);

Route::get('filtrar-animal/{tipo}/{idAnimal}/{idRebano}/{texto}',[AnimalController::class,'filtrarAnimal']);

Route::get('/eventos/{idRebano}',[AnimalController::class,'eventosGeneral']);

Route::get('/eventos-animal/{idAnimal}',[AnimalController::class,'eventosAnimal']);
//Toro
//Agregar Toro
Route::post('/agregar-toro/{idRaza}/{idFinca}',[AnimalController::class,'agregarToro']);
//Listar Toros
Route::get('/toros/{idFinca}',[AnimalController::class,'listarToros']);

Route::get('/consulta-toro/{idToro}',[AnimalController::class,'consultarToro']);

Route::get('/toro-filtro/{tipo}/{idFinca}/{texto}',[AnimalController::class,'filtrarToro']);

Route::put('/modificar-toro/{idToro}',[AnimalController::class,'modificarToro']);

Route::delete('/eliminar-toro/{idToro}',[AnimalController::class,'eliminarToro']);

//Semen Toro
Route::post('/agregar-semen/{idToro}',[AnimalController::class,'agregarSemen']);

Route::put('/estado-semen/{idSemen}',[AnimalController::class,'modificarEstadoSemen']);


//csv
Route::post('/csv-agregar',[AnimalController::class,'agregarMasivo']);