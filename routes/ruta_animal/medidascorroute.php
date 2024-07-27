<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\animalcontroller;


Route::post('/agregar-medida/{idAnimal}',[animalcontroller::class,'agregarMedidas']);

Route::put('/modificar-medida/{idMedida}',[animalcontroller::class,'modificarMedidas']);

Route::get('/listar-medidas/{idMedida}',[animalcontroller::class,'listarMedidas']);

Route::delete('/eliminar-historicos/{idMedida}',[animalcontroller::class,'modificarHistoricosMedidas']);