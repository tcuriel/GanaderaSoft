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

    <link href="{{ asset('assets/css/bootstrap.min53c.css') }}"  rel="stylesheet">

    <script src="{{ asset('assets/js/bootstrap53.bundle.min.js') }}"></script>

    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href=" {{ asset('assets/css/style-new.css') }}">

@stop

@section('body')


<section class="home">

    <div class="contenedor">
        <div class="navbarx image-container">
            <img src="{{ asset('images/ucv 1.svg') }}" alt="">
            <img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
            <img src="{{ asset('images/fagro.svg') }}" alt="">
            <img src="{{ asset('images/Fonacit 1.svg') }}" alt="">
        </div>

        <div class="button-container">
            <a href="{{ route('login') }}"  
                type="button" 
                class="btn btn-clear2 btn-230 btn-lg boton" 
                style="border: 2px solid #148FBE;">
                Inicio de Sesión
            </a>
        </div>
    </div>

    <div class="cover">

        <div id="splash-screen" class="content" >
            <img src="{{ asset('images/VACA-1 1.svg') }}" alt="">
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
        </div>
    </div>  

    <div class="footer">
        <img src="{{ asset('images/Group 36861.svg') }}" alt="">
        <span>GanaderaSoft 2024</span>
    </div>

</section>

<!--script src="{{ asset('js/app.js') }}"></script-->

@stop
