@extends('adminlte::master')

@php
    //$section = "finca";
    //$selectView = "rebano";
    //$selectorViews = config('app.finca-selector-view');
@endphp

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('title', env('APP_NAME', 'GanaderoSoft'))

@section('adminlte_css')

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

  <link rel="stylesheet" href="{{ asset('assets/css/style-new9.css') }}" />

  @yield('content_css')

  <style>

  </style>

@endsection

@section('classes_body')
	sidebar-mini
@endsection

@section('body')

  {{-- Preloader Animation --}}
  @if($layoutHelper->isPreloaderEnabled())
      @include('adminlte::partials.common.preloader')
  @endif

  <div class="wrapper">
    
    {{-- Content Navbar --}}
    @include('partials.navbar.navba-pageFinal')

    {{-- Content Sidebar --}}
    @include('partials.navbar.asiba-pageFinal')

    {{-- Content Main --}}
    <div class="content-wrapper ybg-transparenty">
      <div style="position: fixed;top: 105px;left: 255px;">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="sidebar-toggle-button" 
                  style="display: inline-block;width: 32px;height: 32px;">
                  <!--i class="fas fa-bars"></i-->
                  <img src="{{ asset('images/hsmburgue.png') }}" width="32px" alt="Menú" 
                      style="left: 10px;top: 0;margin-botton: 0;margin-top: 0;padding: 0;">
                </a>
              </li>
            </ul>
      </div>
      <div class="content-header">

        <div class="container-fluid">

          <!--h1 class="m-0 gren-text-color">Bienvenido a data[0]-&gt;Nombre</h1-->
          @yield('content_header')
        </div>
      </div>

      <div class="content">
        <div class="ybg-transparenty">
        
          <div class="wrapper d-flex flex-column justify-content-center">

            @yield('content')

          </div>

        </div>
      </div>
    </div>
    {{-- --}}

    {{-- Content Footer --}}
		<!--footer class="credit"-->
			<div class="footer">
					<img src="{{ asset('images/Group 36861.svg') }}" alt="">
					<span>GanaderaSoft 2024</span>
			</div>
		<!--/footer-->
		{{-- --}}

  </div>

@endsection

@section('adminlte_js')

	<script src="{{ url('/vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

  @yield('content_js')

	<script>
  
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarToggleButton = document.getElementById('sidebar-toggle-button');
      const body = document.querySelector('body');

      sidebarToggleButton.addEventListener('click', function() {
        body.classList.toggle('sidebar-collapse');
      });
    })
  
  </script>

  @yield('js-content')

@endsection
