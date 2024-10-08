@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')

	@vite('resources/sass/app.scss')

	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

    <!-- App style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

	<link rel="stylesheet" href=" {{ asset('assets/css/style-new2.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style-tabs.css') }}">

	@yield('css-content')

	<style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #666
        }

        body {
            background-image: url('/images/fondo_GSx3.svg');
            /*opacity: 0.5; /* Adjust opacity as needed */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Adjust height as needed */
        }
	</style>

@stop

@section('body')

	{{-- Preloader Animation --}}
    @if($layoutHelper->isPreloaderEnabled())
        @include('adminlte::partials.common.preloader')
    @endif


	{{-- Content Main --}}
    <div class="container-main">
	<!--section class="home"-->

		{{-- Content Aside --}}
		@if($mostrar_lateral)
			<aside class="aside">
				<!--yield('lateral')-->
				@include('partials.navbar.asiba-pageAdministrar')
			</aside>
		@endif
		{{-- Content Navbar --}}
		<div class="nav-container">
			<nav class="nav1">

				<div class="instituciones">
					@if($mostrar_instituciones)
						<!--yield('instituciones')-->
						@include('partials.navbar.institucionesAdministrar')
					@endif
				</div>

				{{-- Content navba --}}
				<!-- Content navba -->
				@php
					//print_r(Auth::user());
				@endphp
				<div class="nav-left">
					@include('partials.navbar.navba-pageAdministrar')
				</div>
				<!-- -->
				{{-- --}}

			</nav>
			<nav class="nav2">

        @yield('barra2')

			</nav>
			<!--nav class="nav3">
        @yield('barra3')
			</nav-->
		</div>
		{{-- --}}

		{{-- Content Logo --}}
		{{-- Logo GSoft (estrella solitaria) --}}
		@if($mostrar_estrella_solitaria)
			<div class="">
				<img src="{{ asset('images/VACA-1 14.svg') }}" class="logo-GS" alt="Logo GS">
			</div>
		@endif
		{{-- --}}

		{{-- Content Cover --}}
		<div class="cover-xt">
		  <div style="position: fixed;top: 105px;left: 255px;">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link navbar-burger" data-widget="pushmenu" href="#" role="button" id="sidebar-toggle-button" 
              style="display: inline-block;width: 32px;height: 32px;">
              <!--i class="fas fa-bars"></i-->
              <img src="{{ asset('images/hsmburgue.png') }}" width="32px" alt="Menú" 
                  style="left: 10px;top: 0;margin-botton: 0;margin-top: 0;padding: 0;">
            </a>
          </li>
        </ul>
      </div>
      
			<!--div class="content"-->
        @yield('contenido')
			<!--/div-->
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

	<!--/section-->
    </div>
	{{-- --}}

@stop

@section('adminlte_js')

    @yield('js-content')

@stop
