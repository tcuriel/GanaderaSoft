<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fincacontroller;

Route::post('/movimiento/{idFincaBase}/{idFincaD}/{rebanoDestino}/{rebanoBase}/{tipoMovimiento}/{cantidad}'
                            ,[fincacontroller::class,'moverRebano']);

Route::get('/movimiento-lista/{idFinca}',[fincacontroller::class,'listarMovimientosPendientes']);

Route::put('/actualizar-movimiento/{estado}/{idMovimiento}',[fincacontroller::class,'actualizarEstadoMovimiento']);