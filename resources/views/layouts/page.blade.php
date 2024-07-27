@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @vite(['resources/sass/app.scss', 'resources/sass/app/layouts/styles.scss'])
    @yield('css-content')
    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

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
