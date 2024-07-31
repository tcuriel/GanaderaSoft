@extends('adminlte::master')

@section('classes_body')
    row
    g-0
    min-vh-100
@stop

@section('adminlte_css')
    @vite(['resources/sass/app.scss', 'resources/sass/app/wellcome/styles.scss'])

    <link href="{{ asset('assets/css/bootstrap.min53c.css') }}"  rel="stylesheet">

    <script src="{{ asset('assets/js/bootstrap53.bundle.min.js') }}"></script>
    
    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

    <style>
        .img-logos-instituciones {
            position: absolute;
            top: 0;
            left: 0;
            width: 465px;
            height: 90px;
        }
        
        .modal-body img {
            display: block;
            margin: 0 auto;
        }
        .modal-dialog {
            max-width: 80%;
        }

    </style>
@stop

@section('body')

    <img src="{{ asset('images/logos_instituciones-removebg-preview.png') }}" 
         alt="Logos instituciones"
         class="img-logos-instituciones">

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
                        <a href="{{ route('login') }}" onclick="play()" type="button" class="btn btn-clear2 btn-230 btn-lg" style="border: 2px solid #148FBE;font-weight: bold;">Inicio de Sesión</a>
                    </div>
                    <!--div class=" col-md-4  d-flex justify-content-center">
                        <a href="{{ route('login') }}" type="button" class="btn btn-secundary2cls
                         btn-230">Acerca de</a>
                    </div-->
                    <div class=" col-md-4  d-flex justify-content-center">
                        <!--a href="{{ route('login') }}" type="button" class="btn btn-secundary2 btn-230">Acerca de</a-->
                        <!-- Button trigger modal btn btn-primary -->
                        <button type="button" 
                                class="btn btn-secundary2 btn-230 btn-lg" 
                                style="background-color: #C0D43B;font-weight: bold;"
                                data-bs-toggle="modal" 
                                data-bs-target="#staticBackdrop">
                            Acerca de
                        </button>                    
                    </div>
                </div>
                <div class="frontpage-wellcome"></div>
                <img src="{{ asset('images/CC BY-NC.png') }}" 
                 alt="Creative Commons license: CC BY-NC"
                 class=""
                 style="float: left;">
            </div>
        </div>
    </div>

    <!--footer>
        <div class="footer-container"-->

        <!--/div>
    </footer-->

    <audio id="music">
        <source src="{{ asset('assets/sounds/COW2.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
        Su navegador no soporta el elemento de audio.
    </audio>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Acerca de</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
            
                <img src="{{ asset('images/acerca_de.png') }}" 
                    alt="Creative Commons license: CC BY-NC"
                    class="img-fluid"
                    style="float: left;">

                <!--h2>Sistema Web para la Gestión de los Datos Productivos en la Ganadería Vacuna GanaderaSoft</h2>
 
 
                <h3>Proyecto financiado por el FONACIT</h3>
                
                
                
                
                <h3>Profa. Yosly Hernández Bieluikas</h3>
                <h3>Coordinadora del Proyecto</h3>
                
                <h3>Universidad Central de Venezuela</h3>
                <h3>Facultad de Ciencias</h3>
                <h3>Coordinación de Extensión</h3>


            </div-->
            <div class="modal-footer">
                <!--button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button-->
                <!--button type="button" class="btn btn-primary">Understood</button-->
            </div>
            </div>
        </div>
    </div>

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
