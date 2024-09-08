<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\animalcontroller;


route::post('/establecer-peso/{tipo}/{id_Animal}/{id_Tecnico?}',[animalcontroller::class,'establecerPeso']);

route::put('/actualizar-peso/{idPeso}/{tipo}/{id_Tecnico?}',[animalcontroller::class,'actualizarPesoCorporal']);
