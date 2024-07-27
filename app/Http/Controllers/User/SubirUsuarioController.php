<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Config\Repository;
use App\Models\modelusuario\User;

class SubirUsuarioController extends Controller
{
    function seleccionarArvhivo()
    {   
        
        $user = Auth::user();
        /*
        echo "Her, sy yo, soy yo,...";
        echo "<pre>[";
        print_r($user);
        echo "][";
        //print_r($response);
        echo "]</pre>";
        exit;
        */
        return view('usuario.seleccionar_archivo', ['user' => $user,]);
    }
}
