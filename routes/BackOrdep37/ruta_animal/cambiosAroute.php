<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\animalcontroller;

//cear cambio
Route::post('/cambio/{id_Animal}',[animalcontroller::class,'realizarCambio']);

Route::put('/modificar-cambio/{idCambio}',[animalcontroller::class,'modificarCambio']);

Route::get('/listar-cambio/{idCambio}',[animalcontroller::class,'listarCambios']);

Route::delete('/eliminar-historicos/{idCambio}',[animalcontroller::class,'eliminarHistoricosCambios']);