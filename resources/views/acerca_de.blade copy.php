@extends('adminlte::master')

@section('classes_body')
    row
    g-0
    min-vh-100
@stop

@section('adminlte_css')

    @vite(['resources/sass/app.scss', 'resources/sass/app/wellcome/styles.scss'])

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">  
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

    <!--link href="{{ asset('assets/css/bootstrap.min53c.css') }}"  rel="stylesheet">

    <script src="{{ asset('assets/js/bootstrap53.bundle.min.js') }}"></script-->
    
    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

    <!--link rel="stylesheet" href=" {{ asset('assets/css/style-new.css') }}"-->

    <link rel="stylesheet" href="{{ asset('assets/css/style-tabs.css') }}">

    <style>
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

            flex-direction: column;
            
        }

        .instituciones{
            width: 100%;
            /*height: 72px;    */
            top: 21px;
            left: 17px; 
            display: flex;
            align-items: left;
            justify-content: left;
            box-sizing: border-box;
            position: fixed;
            color: white;
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
        
        .content {
            display: flex; /* Convertimos el contenedor en un flexbox para mejor control de alineación */
            justify-content: center; /* Centra los elementos horizontalmente */
            align-items: center; /* Centra los elementos verticalmente */
            flex-direction: column;
            gap: 50px; /* Espacio entre elementos */
        }

        .content img {
            width: 257px; /* Ajusta el ancho de la imagen */
            height: 258px;
        }

        .content p {
            font-size: 60px;
            font-weight: 500;
            line-height: 90px;
            text-align: left;
            color: #148FBE;
            background-color: gray;

        }

        .title-splash{
            font-family: Poppins;
            font-size: 60px;
            font-weight: 300;
            line-height: 90px;
            text-align: center;
            color: #148FBE;
            /*background-color: gray;*/
        }

        
        @media (max-width: 768px) {
            .content {
            /* Ajustes para pantallas pequeñas */
            }
        }

        .button-container{
            display: flex; /* Convertimos el contenedor en un flexbox para mejor control de alineación */
            justify-content: right; /* Centra los elementos horizontalmente */
            align-items: right; /* Centra los elementos verticalmente */
            top: 66px;
            right: 316px;
            /*width: Fixed (150px)px;
            height: Fixed (40px)px;
            top: 66px;
            left: 1124px;
            padding: 17px 152px 17px 152px;
            gap: 10px;
            border-radius: 10px 0px 0px 0px;
            border: 1px 0px 0px 0px;
            opacity: 0px;*/
        }

        .integrantes{
            width: 100%;
            font-family: Inter;
            font-size: 16px;
            /*font-weight: 700;*/
            line-height: 20px;
            text-align: left;


        }

    </style>

@stop

@section('body')


<section class="home">

    <!--div class="contenedor"-->

        <div class="instituciones">
            <img src="{{ asset('images/ucv 1.svg') }}" alt="">
            <img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
            <img src="{{ asset('images/fagro.svg') }}" alt="">
            <img src="{{ asset('images/Fonacit 1.svg') }}" alt="">
        </div>

        <div class="button-container">
            <a href="{{ route('login') }}"  
                type="button" 
                class="btn btn-clear2 btn-230 btn-lg">
                Inicio de Sesión
            </a>
        </div>

    <!--/div-->

    <div class="cover">

        <div id="splash-screen" class="content" >
            <img src="{{ asset('images/VACA-1 1.svg') }}" alt="">
        </div>
        
    </div> 

        <div class="integrantes">
            <p>
                <span style="font-weight: bold;">Sistema Web para la Gestión de los Datos Productivos en la Ganadería Vacuna GanaderaSoft</span> es un proyecto 
                de investigación desarrollado en la Universidad Central de Venezuela en las
                <br>
                Facultades de Ciencias y Agronomía, con el propósito de sistematizar y automatizar los procesos la producción bovina.
            </p>
            <p> 
                <span style="font-weight: bold;">Financiado por el Fondo Nacional de Ciencia, Tecnología e Innovación, 
                Ministerio del Poder Popular para Ciencia y Tecnología (MINCYT).</span>
            </p>
            <p>
            <span style="font-weight: bold;">Investigadores principales:</span>
            <br>
            Profa. Yosly Hernández Bieliukas. Ciencias UCV<br>
            Profa. Marina Fuentes. Agronomía UCV<br>
            Prof. Daniel Vargas. Agronomía UCV
            </p>
            <p>
            <span style="font-weight: bold;">Equipo de desarrollo:</span>
            <br>
            Aux Docente Juan Luis Fernández,<br>
            Br. Pedro Leal, <br>
            Prof. Tirzo Curiel. Desarrolladores<br>
            Aux Docente Carlos Leal<br>
            </p>
        </div>
        
     

    <div class="footer">
        <img src="{{ asset('images/Group 36861.svg') }}" alt="">
        <span>GanaderaSoft 2024</span>
    </div>

</section>

<!--script src="{{ asset('js/app.js') }}"></script-->

@stop
