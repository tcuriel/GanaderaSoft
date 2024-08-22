@extends('adminlte::master')

@section('adminlte_css')
@vite('resources/sass/app.scss')

    @vite('resources/sass/app/login/styles.scss')

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">  

    <link href="{{ asset('assets/css/bootstrap.min53c.css') }}"  rel="stylesheet">

    <script src="{{ asset('assets/js/bootstrap53.bundle.min.js') }}"></script>

    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href=" {{ asset('assets/css/style-new.css') }}">

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
                <p class="content-title centered">{{ __('GanaderaSoft') }}</p>
                <p class="content-message centered">{{ '¡Has cerrado sesión exitosamente!' }}</p>   <!--  "btn btn-secundary2 btn-230" -->
                <a href="{{ route('login') }}" type="button" class="boton-sigin">Inicio</a>
            </div>

        </div> 

        <div class="footer">
            <img src="{{ asset('images/Group 36861.svg') }}" alt="">
            <span>GanaderaSoft 2024</span>
        </div>

    </div>

@endsection
