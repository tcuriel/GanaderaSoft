<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\animalcontroller;

//agregar raza mixta
Route::post('/agregar-raza/{idFinca}',[animalcontroller::class,'agregarRazaMixta']);

Route::get('/listar-raza/{tipo}/{idFinca}',[animalcontroller::class,'listarRazas']);

Route::delete('/eliminar-raza/{idComposicon}',[animalcontroller::class,'eliminarRazaMixta']);

Route::put('/modificar-raza/{idFinca}/{idComposicion}',[animalcontroller::class,'modificarRazaMixta']);