@extends('adminlte::master')

@section('adminlte_css')

	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- App style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href=" {{ asset('assets/css/style-new.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style-tabs.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Styles.css') }}">

    <style>

		.nav-left{
		    display: flex;
			flex-direction: row; /* Cambia a fila para mostrar las imágenes horizontalmente */
			align-items: flex-start; /* Alinea los elementos por el borde superior */
		}

		.logo-GS{
			position: absolute;
			width: 111px;
			height: 112px;
			top: 89px;
			left: 89px;
			gap: 0px;
			opacity: 0px;
		}
    </style>
    
@stop

@section('welcome-user')
	<h2 class="welcome-user">Bienvenido {{ $user->name }}.</h2>
    @if (isset($user->name))
        <h2 class="welcome-user">Bienvenido {{ $user->name }}.</h2>
    @endif
@stop

@section('body')

	<section class="home">
		<div class="nav-container">
			
			<nav class="nav1">

				<div class="" style="margin-top: 0px;margin-left: 20px;">
					<!--img src="{{ asset('images/ucv 1.svg') }}" alt="">
					<img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
					<img src="{{ asset('images/fagro.svg') }}" alt="">
					<img src="{{ asset('images/Fonacit 1.svg') }}" alt=""-->
				</div>

				<div class="nav-left">
						@include('partials.navbar.navba2-page')
				</div>

			</nav>

			<nav class="nav2">

			</nav>

			<nav class="nav3">

				<ul id="abas" class="teste">
					<li class="selecionada">
						<a id="aba_1" href="#aba_1"> 
						</a>
					</li>
					<li>
						<a id="aba_2" href="#aba_2">
						</a>
					</li>
				</ul>

			</nav>

		</div>

		<div class="">
			<img src="{{ asset('images/VACA-1 14.svg') }}" class="logo-GS" alt="Logo GS">
		</div>

		<div class="cover">

			<!--div class="content"-->
				
			<div id="conteudos">
				<div id="conteudo_1" class="conteudo visivel">
					<p><b>What is CodeHim?</b></p>
					<p> CodeHim is one of the BEST developer websites that provide web designers and developers with a simple way to preview and download a variety of free code &amp; scripts.</p>
					<div>
						Hola hola...
					</div>
				</div>
				<div id="conteudo_2" class="conteudo">
					<p>Conteúdo da Aba 2</p>
				</div>
				<div id="conteudo_3" class="conteudo">
					<p>Conteúdo da Aba 3</p>
				</div>
			</div>

			<!--/div-->

		</div>


		<!--footer class="credit"-->
			<div class="footer">
					<img src="{{ asset('images/Group 36861.svg') }}" alt="">
					<span>GanaderaSoft 2024</span>
			</div>
		<!--/footer-->

	</section>

@stop

@section('adminlte_js')
	
    @yield('js-content')

	<script  src="{{ asset('assets/js/script-tabs.js') }}"></script>

@stop
