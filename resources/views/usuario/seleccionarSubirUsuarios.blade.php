@extends('layouts.page2')

@section('instituciones')
	<!--img src="{{ asset('images/ucv 1.svg') }}" alt="">
	<img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
	<img src="{{ asset('images/fagro.svg') }}" alt="">
	<img src="{{ asset('images/Fonacit 1.svg') }}" alt=""-->
@endsection

@section('barra2')

@endsection

@section('barra3')
<ul id="abas" class="teste">
	<li class="selecionada">
		<a id="aba_1" href="#aba_1" onclick="event.preventDefault()"> 
		</a>
	</li>
	<li>
		<a id="aba_2" href="#aba_2" onclick="event.preventDefault()">
		</a>
	</li>
</ul>
@endsection

@section('contenido')

	<div id="conteudos" class="conteudos">

		<h2 style="width: 60rem;left: 20px;"><--- Subir Usuarios</h2>

		<div id="conteudo_1" class="conteudo visivel">

			<!--include('usuario.table')-->

			<div class="card" style="width: 100%;">
				<div class="card-header">

				</div>
				<div class="card-body">

				<button type = "button" class = "btn btn-secundary upload-btn">Seleccionar Archivos</button>
					<label class="form-label"><span class="text-danger"></span></label>
					<div class = "">
						<div class = "upload-container">
							<div class = "upload-img">
								<img src = "" alt = "" id="blah">
							</div>
							<p class = "upload-text">Arrastre y suelte el archivo aquí</p>
						</div>
						<div>
							<input type = "file" name="image" class = "visually-hidden" id = "image">
						</div>
					</div>

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
				</div>
			</div>

		</div>

		<div id="conteudo_2" class="conteudo">
			<p>Conteúdo da Aba 2</p>
		</div>
		
	</div>
@endsection
