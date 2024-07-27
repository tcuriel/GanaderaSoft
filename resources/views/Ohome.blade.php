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
    <!-- App style -->
    <!--link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}"-->   
@stop

@section('title', env('APP_NAME', 'GanaderoSoft'))

@section('content_header')
    <h1 class="m-0 gren-text-color">Bienvenido a {{$data[0]->Nombre}}</h1>
@stop

@section('content')
    @if($section == "finca")
        @include('finca.home')
    @elseif($section == 'animal')
        @include('animal.home')
    @elseif($section == 'produccion')
        <p>Produccion</p>
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
            navItem.setAttribute('href', href + "/{{ $data[0]->id_Finca }}" );
        }
    </script>
    @yield('js-content-home')
@stop
