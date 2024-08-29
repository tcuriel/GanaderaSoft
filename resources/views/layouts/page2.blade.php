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
    <!--link rel="stylesheet" href="{{-- asset('assets/css/Styles.css') --}}"-->

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
				@yield('lateral')
			</aside>
		@endif
		{{-- Content Navbar --}}
		<div class="nav-container">
			<nav class="nav1">

				<div class="instituciones">
					@if($mostrar_instituciones)
						@yield('instituciones')
					@endif
				</div>

				<div class="nav-left">
					@include('partials.navbar.navba2-page')
				</div>

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

	<script  src="{{ asset('assets/js/script-tabs.js') }}"></script>

@stop
