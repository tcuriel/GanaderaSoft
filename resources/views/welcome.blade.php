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

<<<<<<< HEAD
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">  

    <style>
        body{
            margin: 0px;
            padding: 0px;
            font-family: Poppins, Arial, Helvetica, sans-serif;
        }

        .home{
            width: 100%;
            height: 100vh;
            background-size: cover;
            background-position: center;
        }

        .cover{
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0px 30%;
            box-sizing: border-box;
        }

        .navbarx{
            width: 100%;
            height: 72px;    
            display: flex;
            align-items: left;
            justify-content: left;
            box-sizing: border-box;
            position: fixed;
            color: white;
        }

        .image-container {
            top: 21px;
            left: 17px;    
            gap: 0px;
            opacity: 0px;    
            display: flex;
            flex-direction: row; /* Cambia a fila para mostrar las imágenes horizontalmente */
            align-items: flex-start; /* Alinea los elementos por el borde superior */
        }
        
        .image-container img {
            width: auto;
            height: 64px; /* Ajusta el alto deseado para todas las imágenes */
        }

        .content {
            display: flex; /* Convertimos el contenedor en un flexbox para mejor control de alineación */
            justify-content: center; /* Centra los elementos horizontalmente */
            align-items: center; /* Centra los elementos verticalmente */
            flex-direction: column;
            gap: 0px; /* Espacio entre elementos */
        }
        
        .content img {
            width: 483px; /* Ajusta el ancho de la imagen */
            height: 484px;
        }
        
        .content p {
            font-size: 60px;
            font-weight: 500;
            line-height: 90px;
            text-align: left;
            color: #148FBE;

        }
        
        @media (max-width: 768px) {
            .content {
            /* Ajustes para pantallas pequeñas */
            }
        }

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
            background-color: #f8f9fa; /* Set a background color */
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
=======
    <style>
        .img-logos-instituciones {
            position: absolute;
            top: 0;
            left: 0;
            width: 465px;
            height: 90px;
>>>>>>> d063b4ed1712aa7c724456a76d7e5cce17469e65
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

<<<<<<< HEAD
        <div class="navbarx image-container">
            <img src="{{ asset('images/ucv 1.svg') }}" alt="">
            <img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
            <img src="{{ asset('images/Agronomía-removebg-preview 1.svg') }}" alt="">
            <img src="{{ asset('images/Fonacit 1.svg') }}" alt="">
        </div>
=======
    <img src="{{ asset('images/logos_instituciones-removebg-preview.png') }}" 
         alt="Logos instituciones"
         class="img-logos-instituciones">
>>>>>>> d063b4ed1712aa7c724456a76d7e5cce17469e65

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
                <img src="{{ asset('images/CC BY-NC.png') }}" 
                 alt="Creative Commons license: CC BY-NC"
                 class=""
                 style="float: left;">
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <div class="footer bg-transparent">
        <img src="{{ asset('images/Group 36861.svg') }}" alt="">
        <span>GanaderaSoft 2024</span>
    </div>
=======
    <!--footer>
        <div class="footer-container"-->

        <!--/div>
    </footer-->
>>>>>>> d063b4ed1712aa7c724456a76d7e5cce17469e65

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
<<<<<<< HEAD
=======

                <!--h2>Sistema Web para la Gestión de los Datos Productivos en la Ganadería Vacuna GanaderaSoft</h2>
 
 
                <h3>Proyecto financiado por el FONACIT</h3>
                
                
                
                
                <h3>Profa. Yosly Hernández Bieluikas</h3>
                <h3>Coordinadora del Proyecto</h3>
                
                <h3>Universidad Central de Venezuela</h3>
                <h3>Facultad de Ciencias</h3>
                <h3>Coordinación de Extensión</h3>


            </div-->
>>>>>>> d063b4ed1712aa7c724456a76d7e5cce17469e65
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
