<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;


route::post('/establecer-peso/{tipo}/{id_Animal}/{id_Tecnico?}',[AnimalController::class,'establecerPeso']);

route::put('/actualizar-peso/{idPeso}/{tipo}/{id_Tecnico?}',[AnimalController::class,'actualizarPesoCorporal']);
