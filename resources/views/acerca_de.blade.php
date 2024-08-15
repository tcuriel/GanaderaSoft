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

    .contenedor{
        width: 100%;
        height: 72px;    
        display: flex; /* Convertimos el contenedor en un flexbox para mejor control de alineación */
        justify-content: left; /* Centra los elementos horizontalmente */
        align-items: left; /* Centra los elementos verticalmente */
        flex-direction: column;
        gap: 50px; /* Espacio entre elementos */
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

    .button-container{
        display: flex;
        height: 200px; /* Ajusta esta altura según tus necesidades */
    }

    .boton {
        width: Fixed (150px)px;
        height: Fixed (40px)px;
        gap: 10px;
        border-radius: 10px 10px 10px 10px;
        border: 1px 0px 0px 0px;
        opacity: 0px;
        margin-left: auto; /* Empuja el botón hacia la derecha */
        margin-top: 66px;
        margin-right: 316px;
        /* Agrega estilos adicionales para el botón aquí, como background-color, color, etc. */
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
        font-size: 20px;
        font-family: Inter, Arial, Helvetica, sans-serif;
        /*font-weight: 500;*/
        line-height: 25px;
        text-align: left;
        color: black;

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
    
    .modal-body img {
        display: block;
        margin: 0 auto;
    }
    .modal-dialog {
        max-width: 80%;
    }

    .integrantes{
        width: 1124px;
        height: 425px;
        left: 95px;
        gap: 0px;
        opacity: 0px;
    }
</style>

@stop

@section('body')


<section class="home">

    <div class="contenedor">
        <div class="navbarx image-container">
            <img src="{{ asset('images/ucv 1.svg') }}" alt="">
            <img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
            <img src="{{ asset('images/Agronomía-removebg-preview 1.svg') }}" alt="">
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
                Profa. Yosly Hernández Bieliukas. Ciencias UCV<br>
                Profa. Marina Fuentes. Agronomía UCV<br>
                Prof. Daniel Vargas. Agronomía UCV
                </p>
                <p>
                <span style="font-weight: bold;">Equipo de desarrollo:</span>
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
