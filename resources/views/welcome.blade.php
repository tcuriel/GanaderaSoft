@extends('adminlte::master')

@section('classes_body')
    row
    g-0
    min-vh-100
@stop

@section('adminlte_css')  
  
    @vite('resources/sass/app.scss')
    @vite('resources/sass/app/wellcome/styles.scss')

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">  

    <link href="{{ asset('assets/css/bootstrap.min53c.css') }}"  rel="stylesheet">

    <script src="{{ asset('assets/js/bootstrap53.bundle.min.js') }}"></script>
    
    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href=" {{ asset('assets/css/style-new.css') }}">
    
@stop

@section('body')

        <div class="navbarx image-container">
            <img src="{{ asset('images/ucv 1.svg') }}" alt="">
            <img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
            <img src="{{ asset('images/fagro.svg') }}" alt="">
            <img src="{{ asset('images/Fonacit 1.svg') }}" alt="">
        </div>

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
                </div>  <!-- config('app.name') -->
                <h2 class="title-black">{{ 'GanaderaSoft' }}</h2>
                <div class="card">
                    <p class="text-wellcome" style="padding: 10px;">
                        "Ganaderasoft es el software ideal para mejorar la toma de decisiones y maximizar la rentabilidad de su
                        negocio, porque, permitirá a los productores tener en sus manos una herramienta efectiva para gestionar y
                        optimizar el manejo detallado del inventario ganadero, la gestión de la reproducción y la producción,
                        así como la sanidad, entre otros"                    
                    </p>
                </div>
            </div>
            <div class="col-md-8 overflow-hidden">
                <div class="row g-0">
                    <div class=" col-md-4 d-flex justify-content-center">
                        <a href="{{ route('login') }}" 
                           onclick="play()" 
                           type="button" 
                           class="btn btn-clear2 btn-230 btn-lg" 
                           style="border: 2px solid #148FBE;">
                            Inicio de Sesión
                        </a>
                    </div>
                    <div class="col-md-4  d-flex justify-content-center">
                        <a href="{{ route('acerca_de') }}" 
                           onclick="play()" 
                           type="button" 
                           class="btn btn-secundary2 btn-230 btn-lg" 
                           style="background-color: #C0D43B;">
                            Acerca de
                        </a>                    
                    </div>
                </div>
                <div class="frontpage-wellcome"></div>
            </div>
        </div>
    </div>

    <div class="footer bg-transparent">
        <img src="{{ asset('images/Group 36861.svg') }}" alt="">
        <span>GanaderaSoft 2024</span>
    </div>

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
