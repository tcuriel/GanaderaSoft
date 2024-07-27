@extends('adminlte::master')

@section('classes_body')
    row
    g-0
    min-vh-100
@stop

@section('adminlte_css')
    @vite(['resources/sass/app.scss', 'resources/sass/app/wellcome/styles.scss'])
    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">
@stop

@section('body')

    <a class="btn btn-default btn-flat btn-block"
        href="#" onclick="event.preventDefault(); 
        document.getElementById('logout-form').submit();" style="color: white;">
        <!--i class="fa fa-fw fa-power-off text-red"></i-->
        {{ __('adminlte::adminlte.log_out') }}
    </a>
    <form id="logout-form" action="logout" method="POST" style="display: none;">
        @if(config('adminlte.logout_method'))
            {{ method_field(config('adminlte.logout_method')) }}
        @endif
        {{ csrf_field() }}
    </form>

    <div class="col-xl-11 ml-auto d-flex flex-column justify-content-center py-86">
        <div class="row m-0 h-100">
            <div class="col-md-4 d-flex flex-column justify-content-center">
                <div class="login-logo-colum">
                    <div class="complete-logo-app"></div>
                </div>
                <h2 class="title-blue">{{ config('app.name') }}</h2>
                <div class="card">
                    <p class="text-wellcome" style="font-style: italic;padding: 10px;">
                        "Ganaderasoft es el software ideal para mejorar la toma de decisiones y maximizar la rentabilidad de su
                        negocio, porque, permitirá a los productores tener en sus manos una herramienta efectiva para gestionar y
                        optimizar el manejo detallado del inventario ganadero, la gestión de la reproducción y la producción,
                        así como la sanidad, entre otros"                    </p>
                </div>
            </div>
            <div class="col-md-8 overflow-hidden">
                <div class="row g-0">
                    <!--div-- class="col-md-4 d-flex justify-content-center">
                        <a href="{{ route('register') }}" type="submit" class="btn btn-secundary btn-230">Registro</a>
                    </!--div-->
                    <!--div class=" col-md-4 d-flex justify-content-center">
                        <a href="{{ route('login') }}" type="button" class="btn btn-clear2 btn-230">Inicio de Sesión</a>
                    </div-->
                    <div class=" col-md-4 d-flex justify-content-center">
                        <a href="{{ route('login') }}" onclick="play()" type="button" class="btn btn-clear2 btn-230" style="border: 2px solid #148FBE">Inicio de Sesión</a>
                    </div>
                    <!--div class=" col-md-4  d-flex justify-content-center">
                        <a href="{{ route('login') }}" type="button" class="btn btn-secundary2cls
                         btn-230">Acerca de</a>
                    </div-->
                    <div class=" col-md-4  d-flex justify-content-center">
                        <a href="{{ route('login') }}" type="button" class="btn btn-secundary2 btn-230">Acerca de</a>
                    </div>
                </div>
                <div class="frontpage-wellcome"></div>
            </div>
        </div>
    </div>

    <audio id="music">
        <source src="{{ asset('assets/sounds/COW2.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
        Su navegador no soporta el elemento de audio.
    </audio>

    <script>
        var myMusic= document.getElementById("music");
        function play() {
        myMusic.play();
        }
        function pause() {
        myMusic.pause();
        }
    </script>
@stop
