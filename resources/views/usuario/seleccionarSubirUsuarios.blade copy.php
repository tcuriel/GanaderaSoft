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

				<!--div class="" style="margin-top: 0px;margin-left: 20px;">
					<img src="{{ asset('images/ucv 1.svg') }}" alt="">
					<img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
					<img src="{{ asset('images/fagro.svg') }}" alt="">
					<img src="{{ asset('images/Fonacit 1.svg') }}" alt="">
				</div-->

				<div class="nav-left">
					@include('partials.navbar.navba2-page')
				</div>

			</nav>

			<nav class="nav2">

			</nav>

			<nav class="nav3">
				<div id="tabContainer">
					<div id="tabs">
						<ul>
							<li id="tabHeader_1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
							<li id="tabHeader_2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
						</ul>
					</div>
				</div>
			</nav>

		</div>

		<div class="">
			<img src="{{ asset('images/VACA-1 14.svg') }}" class="logo-GS" alt="Logo GS">
		</div>

		<!--div class="cover"-->

			<div class="content">
				
				<div class="container flex-container d-flex justify-content-center" style="margin: 25px;">

					<div class="">
						<h2 style="width: 60rem;"><--- Subir Usuarios</h2>
					</div>

					<div class="card" style="width: 60rem;">
						
						<div class="card-header"></div>

						<div class="card-body">
							<button type = "button" class = "btn btn-secundary upload-btn">Seleccionar Archivos</button>
							<label class="form-label"><span class="text-danger"></span></label>

							<div class="mb-3">
								<label for="disabledSelect" class="form-label">Separación CSV:</label>
								<select id="disabledSelect" class="form-select">
									<option>,</option>
								</select>
							</div>
							<div class="mb-3">
								<label for="disabledSelect" class="form-label">Codificación:</label>
								<select id="disabledSelect" class="form-select">
									<option>UTF-8</option>
								</select>
							</div>
							<div class="mb-3">
								<label for="disabledSelect" class="form-label">Previsualizar filas:</label>
								<select id="disabledSelect" class="form-select">
									<option>10</option>
								</select>
							</div>

							<div class="col-lg-5">    <!-- class="btn btn-secundary mt-3 mt-lg-0 w-100" -->
								<button type="submit" class="btn btn-secundary2 btn-230">{{ __('Subir Usuario') }}</button>
							</div>
					
							<!-- Start DEMO HTML (Use the following code into your project)-->
							<div id="">
								<div id="tabscontent">
									<div class="tabpage" id="tabpage_1">
										<h2>Page 1</h2>
										<p> X </p>
									</div>
									<div class="tabpage" id="tabpage_2">
										<h2>Page 2</h2>
										<p> Y </p>
									</div>
								</div>
							</div>
							<!-- END EDMO HTML (Happy Coding!)-->

						</div>

					</div>
				</div>

			</div>
		<!--/div-->


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