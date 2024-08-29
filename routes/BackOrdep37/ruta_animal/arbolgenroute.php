<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\animalcontroller;


Route::post('/establecer-arbol/{id_Animal}',[animalcontroller::class,'establecerArbolGenealogico']);

Route::get('/opciones/{etapa}/{idFinca}/{generacion}',[animalcontroller::class,'opcionesArbol']);

Route::get('/consultar-arbol/{id_Animal}',[animalcontroller::class,'consultarArbolGenealogico']);

Route::get('/informacion-ascendente/{id_Animal}',[animalcontroller::class,'informacionAscendente']);
