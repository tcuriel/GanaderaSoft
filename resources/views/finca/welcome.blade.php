@extends('layouts.page')

@section('css-content')
    @vite('resources/sass/app/finca/stylewelcomefarm.scss')

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #666
        }

        body {
            background-image: url('/images/fondo_GS.png');
            /*opacity: 0.5; /* Adjust opacity as needed */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Adjust height as needed */
        }
	</style>
    
    <style>
        .box-GS-hf {
            display: flex;
            flex-direction: row; /* Cambia a fila para mostrar las imágenes horizontalmente */
            justify-content: left;
            align-items: center;

            position: absolute;
            top: 17px;
            left: 235px;

            /*background-color: rgba(209, 176, 193, 0.3);*/
        }

        .logo-GS-hf {
            width: 94px;
            height: 95px;
        }

        .titulo-GS-hf {            
            font-family: Poppins;
            font-size: 50px;
            font-weight: 700;
            line-height: 66px;
            letter-spacing: 1px;
            text-align: left; /* Alineamos el texto a la izquierda */
        }
    </style>
@stop

@section('welcome-user')

    <div class="box-GS-hf">
        <img src="{{ asset('images/VACA-1 14.svg') }}" class="logo-GS-hf" alt="Logo GS">
        <span class="titulo-GS-hf"> Bienvenido ({{ $user->name }}) </span>
    </div>
    

@stop

@section('body-content')
  @include('finca.formwelcomefarms')
@stop

@section('js-content')
    @vite('resources/js/finca/welcomefincaform.js')
@stop
