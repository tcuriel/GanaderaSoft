@extends('layouts.page2')

@php
    $cargar_tabs = false;
    $mostrar_instituciones = false;
    $mostrar_estrella_solitaria = true;
    $mostrar_lateral = true;
    $mostrar_btn_inicio_sesion = false;
@endphp

@section('classes_body')
    row
    g-0
    min-vh-100
@endsection

@section('css-content')

    @vite('resources/sass/app/wellcome/styles.scss')

	<!-- Data Tables style -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap452.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4x.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/responsive.bootstrap4x.css') }}">

@endsection

@section('instituciones')

@endsection

@section('barra2')

    <div class="nav2-container">
        {{-- Tabs --}}
        <div class="item nav2-tabs-container">
            <h2>Administrar Sistema GanaderaSoft</h2>

        </div>

        {{-- Botón (Inicio de Sesión) --}}
        <div class="item nav2-btn-container">
            @if($mostrar_btn_inicio_sesion)
                <a href="{{ route('login') }}"
                    type="button"
                    class="btn btn-clear2 btn-230 btn-lg"
                    style="justify-content: right;align-items: right;">
                    Inicio de Sesión
                </a>
            @endif
        </div>

    </div>

@endsection

@section('barra3')

@endsection

@section('lateral')

@endsection

@section('contenido')

	<div id="conteudos" class="conteudos">

	<div class="conteudos_tabs">

		<ul id="abas" class="teste">

			@if($cargar_tabs)
				<li class="selecionada">
					<a id="aba_1" href="#aba_1" onclick="event.preventDefault()">
					</a>
				</li>
				<li>
					<a id="aba_2" href="#aba_2" onclick="event.preventDefault()">
					</a>
				</li>
			@endif
			
		</ul>

	</div>

	<div id="conteudo_1" class="conteudo visivel">
		@include('usuario.table4')
	</div>

	<div id="conteudo_2" class="conteudo">

		</div>

	</div>

@endsection

@section('js-content')
	
	<!-- Data Tables js -->
    <!--script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script-->
    <script src="{{ asset('assets/js/popper.min4.js') }}"></script>
    <!--script src="{{ asset('assets/js/bootstrap.min452.js') }}"></script-->
    <script src="{{ asset('assets/js/dataTables215.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4x.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.responsive303.js') }}"></script>
    <script src="{{ asset('assets/js/responsive.bootstrap4x.js') }}"></script>

	<script>
		var table = new DataTable('#usuarios', {
    		language: {
        		url: "{{ asset('assets/json/es-MX.json') }}",
   			},
			responsive: true,
			autoWidth: false,
            pageLength: 5,
            searching: true
		});

	</script>
@stop
