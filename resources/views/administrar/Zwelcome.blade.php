@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @vite(['resources/sass/app.scss', 'resources/sass/app/layouts/styles.scss'])
    @yield('css-content')
@stop

@section('classes_body')
    body-page
@stop

@section('body')
  <!--include('finca.formwelcomefarms')-->

  <div class="wrapper">

    {{-- Preloader Animation --}}
    @if($layoutHelper->isPreloaderEnabled())
        @include('adminlte::partials.common.preloader')
    @endif

    {{-- Content Navbar --}}

    @include('partials.navbar.navba-page')
    <div class="wrapper d-flex flex-column justify-content-center">

        @yield('body-content')

    </div>

  </div>

@stop

@section('body-content')
  <!--include('finca.formwelcomefarms')-->
  Her, soy yo, soy yo,...
@stop

@section('js-content')
    @vite('resources/js/finca/welcomefincaform.js')
@stop
