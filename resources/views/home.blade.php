@extends('adminlte::page')

@section('adminlte_css')
    @vite(['resources/sass/app.scss'])
    @vite(['resources/sass/app/ganadegasof.scss'])
    @vite(['resources/sass/app/home/homestyle.scss'])
    @if($section == "finca")
        @vite(['resources/sass/app/finca/homefinca.scss'])
    @elseif($section == "animal")
        @vite(['resources/sass/app/animal/homeanimal.scss'])
    @endif

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #666
        }

        body {
            background-image: url('/images/fondo_GS.png');
            /*opacity: 0.5; /* Adjust opacity as needed */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Adjust height as needed */
        }

        aside {
            background-color: #E6F4E7;
        }

        .tarjeta {
            /*background-color: #E6F4E7;*/
            /*border: 0px;*/
            background-color: #c4d741; /* Slightly lighter shade */
            opacity: 0.8; /* Adjust opacity as needed */
        }

        .bg-transparent{
            background-color: transparent;
            border: 0px;
        }

        .bg-aside{
            background-color: #61b5d5; /* Slightly lighter shade */
            opacity: 0.8; /* Adjust opacity as needed */
        }
    </style>

@stop

@section('title', env('APP_NAME', 'GanaderoSoft'))

@section('content_header')
    <!--h1 class="m-0 gren-text-color">Bienvenido a {{ 'Propietario1' }}</h1-->

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 gren-text-color">Bienvenido a {{ 'Propietario1' }}</h1>
                </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Propietario</li>
                </ol>
            </div>
        </div>
  </div>
@stop

@section('content')
    @if($section == "propietario")
        @include('finca.propietario')
    @elseif($section == "finca")
        @include('finca.home')
    @elseif($section == 'animal')
        @include('animal.home')
    @elseif($section == 'produccion')
        <p>Produccion</p>
    @elseif($section == 'reproduccion')
        <p>Reproduccion</p>
        @include('finca.home')
        @include('animal.home')
    @elseif($section == 'sanidad')
        <p>Sanidad</p>
    @elseif($section == 'reporte')
        <p>Reporte</p>
    @endif
@stop
@section('js')
    <script>
        let navItems = document.querySelectorAll('.nav-pills .nav-link');
        let sectionName = "{{$section}}";
        let viewName = "{{$selectView}}";
        let navItem = document.getElementById(sectionName + 'Section');
        if (navItem) {
            const navLink = navItem.querySelector('.nav-link');
            navLink.classList.add('active');
        }
        for (const navItem of navItems) {
            const href = navItem.getAttribute('href');
            navItem.setAttribute('href', href + "/{{ '275' }}" );
        }
    </script>
    @yield('js-content-home')
@stop
