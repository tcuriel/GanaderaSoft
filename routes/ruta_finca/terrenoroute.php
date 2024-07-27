<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fincacontroller;

//Actualizar datos de terreno
Route::put('/modificar-terreno/{id_terreno}',[fincacontroller::class, 'terrenoUpdate']);
