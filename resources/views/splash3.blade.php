@extends('adminlte::master')

@section('adminlte_css')
    <!--vite(['resources/sass/app.scss', 'resources/sass/app/wellcome/styles.scss'])-->
    <!-- App style -->
    <!--link rel="stylesheet" href=" // asset('assets/css/style.css') }}"-->
    
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
        }
    </style>
@endsection

@section('body')

    <section class="home">
        
        <div class="navbarx image-container">
            <img src="{{ asset('images/ucv 1.svg') }}" alt="">
            <img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
            <img src="{{ asset('images/fagro.svg') }}" alt="">
            <img src="{{ asset('images/Fonacit 1.svg') }}" alt="">
        </div>

        <div class="cover">

            <div id="splash-screen" class="content" >
                <img src="{{ asset('images/VACA-1 1.svg') }}" alt="">
                <p>GanaderaSoft</p>
            </div>
            
        </div>  

        <div class="footer">
            <img src="{{ asset('images/Group 36861.svg') }}" alt="">
            <span>GanaderaSoft 2024</span>
        </div>

    </section>

    <!--script src="{{ asset('js/app.js') }}"></script-->

    <script>
        // Set timeout for splash screen display
        setTimeout(() => {
            document.getElementById('splash-screen').classList.add('fade-out');

            // Redirect to the next page after fade-out animation completes
            setTimeout(() => {
                window.location.href = "{{ route('welcome') }}";
            }, 1000); // Adjust the delay for redirect as needed
        }, 3000); // Adjust the display time for the splash screen as needed
    </script>
@endsection
