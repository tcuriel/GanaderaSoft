@extends('adminlte::master')

@section('adminlte_css')
    @vite('resources/sass/app.scss')
    @vite('resources/sass/app/login/styles.scss')
    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href=" {{ asset('assets/css/stylex.css') }}">
@endsection

@section('body')
    <div class="my-container">
        <img src="{{ asset('images/VACA-1_1.png') }}" 
             alt="Image" 
             width="250px" height="250px">
        <p class="centered" style="font-size: 32pt;font-weight: bold;color: #148FBE;">{{ 'GanaderaSoft' }}</p>
        <p class="centered" style="font-size: 18pt;font-weight: bold;color: #000000;">
            ¡El correo elctrónico ha sido enviado!    
        </p>

        <p  style="font-size: 10pt;font-weight: bold;color: #000000;">
            Te hemos enviado un correo electrónico a tu dirección<br>
            coninstrucciones sobre cómo reestablecer tu contraseña.<br>
            Si no lo recibes en unos minutos comprueba que has usado<br>
            la dirección correcta registrada en GanaderaSoft e<br>
            inténtalo nuevamente, o ponte en contacto con nosotros para<br>
            obtener ayuda.
        </p>
        <a href="{{ route('login') }}" type="button" class="btn btn-clear2 btn-400" style="font-weight: bold;">Iniciar Sesión</a>
        </div>
    
@endsection