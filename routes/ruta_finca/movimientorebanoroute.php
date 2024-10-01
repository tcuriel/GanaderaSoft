<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FincaController;

Route::post('/movimiento/{idFincaBase}/{idFincaD}/{rebanoDestino}/{rebanoBase}/{tipoMovimiento}/{cantidad}'
                            ,[FincaController::class,'moverRebano']);

Route::get('/movimiento-lista/{idFinca}',[FincaController::class,'listarMovimientosPendientes']);

Route::put('/actualizar-movimiento/{estado}/{idMovimiento}',[FincaController::class,'actualizarEstadoMovimiento']);