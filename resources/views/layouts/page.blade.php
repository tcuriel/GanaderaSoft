@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')

    @vite(['resources/sass/app.scss', 'resources/sass/app/layouts/styles.scss'])
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

    @yield('css-content')
    
    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

    <style>

    </style>

@stop

@section('classes_body')
    body-page
@stop

@section('body')
    {{-- Preloader Animation --}}
    @if($layoutHelper->isPreloaderEnabled())
        @include('adminlte::partials.common.preloader')
    @endif

    {{-- Content Navbar --}}

    @include('partials.navbar.navba-page')
    <div class="wrapper d-flex flex-column justify-content-center">

        @yield('body-content')

    </div>
@stop

@section('adminlte_js')
    @yield('js-content')
@stop
