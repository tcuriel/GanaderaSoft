@extends('layouts.page')

@section('css-content')
    @vite('resources/sass/app/finca/stylefrontpagefinca.scss')

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

    <!--link rel="stylesheet" href=" {{ asset('assets/css/style-new2.css') }}"-->

    <style>
        .footer {
            left: 17px;
            display: flex;
            flex-direction: row;
            justify-content: left;
            align-items: center;
            gap: 0px;
            opacity: 0px;
            position: fixed; /* Fix the footer to the bottom */
            bottom: 0; /* Place it at the absolute bottom */
            width: 100%; /* Span the full width of the viewport */
            background-color: bg-transparent; /* Set a background color */
            padding: 20px; /* Add some padding for spacing */

        }

        .footer span{
            font-family: Poppins;
            font-size: 13px;
            font-weight: 500;
            line-height: 19.5px;
            text-align: left;
            color: black;
        }

        .footer img{
            margin-right: 5px;
        }

        .logo-GS{
            position: absolute;
            width: 135px;
            height: 136px;
            top: 154px;
            left: 66px;
            gap: 0px;
            opacity: 0px;
        }

        .boton{
            width: Fixed (140px)px;
            height: Fixed (40px)px;
            top: 658px;
            left: 66px;
            padding: 17px;
            gap: 10px;
            border-radius: 10px;
            opacity: 0px;

            font-family: Inter;
            font-size: 15px;
            font-weight: 300;
            line-height: 18.75px;
            text-align: center;
            color: black;

        }

        .titulo{
            font-family: Poppins;
            font-size: 40px;
            font-weight: 700;
            line-height: 66px;
            letter-spacing: 1px;
            text-align: left;
            color: black;

        }
        .texto{
            font-family: Inter;
            font-size: 20px;
            font-weight: 400;
            line-height: 30px;
            text-align: left;
            color: black;
        }
    </style>
@stop

@section('body-content')

<div class="">
    <img src="{{ asset('images/VACA-1 14.svg') }}" class="logo-GS" alt="Logo GS">
</div>

<div-- class="row">
    <div class="col content d-flex flex-column justify-content-center">
        <h2 class="titulo">¡Hola! ({{ $user->name }}) </br>
        vemos que no posees una Finca para gestionarla</h2>
        <p class="text-wellcome">Si deseas crear una Finca, presiona el siguiente botón:</p>
        <a href="{{ route('createmyfarm') }}" type="button" class="btn btn-secundary boton">Crear Finca</a>
    </div>
</div>

<div class="footer bg-transparent">
    <img src="{{ asset('images/Group 36861.svg') }}" alt="">
    <span>GanaderaSoft 2024</span>
</div>
@stop
