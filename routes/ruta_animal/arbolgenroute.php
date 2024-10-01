<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;


Route::post('/establecer-arbol/{id_Animal}',[AnimalController::class,'establecerArbolGenealogico']);

Route::get('/opciones/{etapa}/{idFinca}/{generacion}',[AnimalController::class,'opcionesArbol']);

Route::get('/consultar-arbol/{id_Animal}',[AnimalController::class,'consultarArbolGenealogico']);

Route::get('/informacion-ascendente/{id_Animal}',[AnimalController::class,'informacionAscendente']);
