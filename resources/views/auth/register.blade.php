@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('adminlte_css')
    @vite('resources/sass/app.scss')
    @vite('resources/sass/app/register/styles.scss')

    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

    <style>
		.wrapper{
            display: flex;
            flex-direction: column; /* Arrange flex items vertically (button below div) */
            align-items: center; /* Center flex items horizontally */
		}
		.upload-img{
				max-width: 120px;
				margin-right: auto;
				margin-left: auto;
				position: relative;
		}
		.upload-img img{
				width: 100%;
		}
		.upload-text{
				color: rgba(0, 0, 0, 0.2);
				font-weight: 600;
				margin-top: 12px;
		}
		.upload-container{
                width: 250px;
				border: 2px dashed rgba(0, 0, 0, 0.2);
				border-radius: 6px;
				padding: 28px;
				cursor: pointer;
				transition: all 300ms ease-in-out;
		}
		.upload-container:hover{
				background-color: rgba(253, 59, 132, 0.02);
				border-color: rgba(254, 132, 138, 1);
		}
		.upload-btn{
				background: rgb(253, 59, 132);
				/*background: radial-gradient(circle, rgba(253, 59, 132, 1) 35%, rgba(254, 132, 138, 1) 100%);*/
				border: none;
				font-family: inherit;
				font-size: 17px;
				color: #fff;
				padding: 7px 18px;
				margin-top: 24px;
				border-radius: 5px;
				cursor: pointer;
				/*box-shadow: rgb(200, 41, 102) 0px 8px 10px -11px;*/
				transition: all 0.3s ease-in-out;
		}
		.upload-btn:hover{
				box-shadow: rgb(200, 41, 102) 0px 8px 10px -9px;
		}
		.visually-hidden{
				display: none;
		}
	</style>

@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_body')
    <div class="row">
        <div class="col-12 col-lg-11 col-md-12 mx-auto">
            <h2 class="title-black page-title d-md-none">Regístrate</h2>
            <!--form action="{{route('upload')}}" method="POST" enctype="multipart/form-data" "{{ $register_url }}" "{{ route('storeregister') }}" -->
            <form class="form-app" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 order-md-last">
                        <div class="register-logo-colum">
                            <div class="logo-app"></div>
                            <h1 class="primary-title primary-title-shadow page-title-bg">{{ config('app.name') }}</h1>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h2 class="title-black page-title d-none d-md-block">Regístrate</h2>
                        <div class="row">
                            <div class="col-sm-6">
                                {{-- Name field --}}
                                <label class="form-label"><span class="text-danger">(*)</span>
                                {{ __('adminlte::adminlte.name') }}</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.name') }}" autofocus>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- LastName field --}}
                                <label class="form-label"><span class="text-danger">(*)</span>
                                {{ __('adminlte::adminlte.lastname') }}</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror"
                                        value="{{ old('lastname') }}" placeholder="{{ __('adminlte::adminlte.lastname') }}" autofocus>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- Phone field --}}
                                <label class="form-label"><span class="text-danger">(*)</span>
                                    Teléfono</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="cellphone" class="form-control @error('cellphone') is-invalid @enderror"
                                        value="{{ old('cellphone') }}" placeholder="+58">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-mobile"></span>
                                        </div>
                                    </div>

                                    @error('cellphone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Botones-->
                                <label><br></label>
                                <div class="d-none d-sm-block">
                                    <div class="row g-0">
                                        <div class="col-12">
                                            {{-- Register button --}}
                                            <button type="submit" class="btn btn-primary w-100 mb-3">{{ __('adminlte::adminlte.create_account') }}</button>
                                        </div>
                                        <div class="col-lg-6 pr-0 pr-lg-1">
                                            <a href="{{ route('login') }}" type="button" class="btn btn-clear w-100 mb-0 mb-sm-3">
                                            {{ __('adminlte::adminlte.have_account') }}, {{ __('adminlte::adminlte.sign_in') }}</a>
                                        </div>
                                        <div class="col-lg-6 pl-0 pl-lg-1">
                                            <a href="{{ route('login') }}" type="button" class="btn btn-clear w-100">
                                                Continuar con Google</a>
                                        </div>
                                        <label class="col-12 form-label mt-3"><span class="text-danger">(*)</span>
                                        {{ __('adminlte::adminlte.required_camp') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {{-- Email field --}}
                                <label class="form-label"><span class="text-danger">(*)</span>
                                {{ __('adminlte::adminlte.email') }}</label>
                                <div class="input-group mb-3">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Password field --}}
                                <label class="form-label"><span class="text-danger">(*)</span>
                                {{ __('adminlte::adminlte.password') }}</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                        placeholder="{{ __('adminlte::adminlte.password') }}">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Confirm password field --}}
                                <label class="form-label"><span class="text-danger">(*)</span>
                                {{ __('adminlte::adminlte.retype_password') }}</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        placeholder="{{ __('adminlte::adminlte.retype_password') }}">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <label class="form-label"><span class="text-danger">(*)</span>
                                {{ __('adminlte::adminlte.type_user') }}</label>
                                <select class="w-100" name="type_user" aria-label="select type user">
                                    <option hidden>{{ __('adminlte::adminlte.type_user') }}</option>
                                    <option value="Propietario">Propietario</option>
                                    <option value="Ingenierio">Transcriptor Ingeniero</option>
                                    <option value="Veterinario">Transcriptor Veterinario</option>
                                    <option value="Asistente">Transcriptor Asistente</option>
                                    <option value="Administrar">Administrador Sistema</option>
                                </select>


                                <label class="form-label"><span class="text-danger"></span>
                                {{ __('adminlte::adminlte.image') }}</label>
                                <div class = "wrapper">
                                    <div class = "upload-container">
                                        <div class = "upload-img">
                                            <img src = "images/upload.png" alt = "" id="blah">
                                        </div>
                                        <p class = "upload-text">Elija imagen para cargar.</p>
                                    </div>
                                    <div>
                                        <input type = "file" name="image" class = "visually-hidden" id = "image">
                                        <button type = "button" class = "btn btn-secundary upload-btn">Escoge una foto</button>
                                    </div>
                                </div>


                                <!-- Botones-->
                                <label><br></label>
                                <div class="d-block d-sm-none">
                                    <div class="row g-0">
                                        <div class="col-12">
                                            {{-- Register button --}}
                                            <button type="submit" class="btn btn-primary w-100 mb-3">{{ __('adminlte::adminlte.create_account') }}</button>
                                        </div>
                                        <div class=" col-lg-6">
                                            <a href="{{ route('login') }}" type="button" class="btn btn-clear w-100 mb-3">
                                            {{ __('adminlte::adminlte.have_account') }}, {{ __('adminlte::adminlte.sign_in') }}</a>
                                        </div>
                                        <div class=" col-lg-6">
                                            <a href="{{ route('login') }}" type="button" class="btn btn-clear w-100">
                                                Continuar con Google</a>
                                        </div>
                                        <label class="col-12 form-label mt-3"><span class="text-danger">(*)</span>
                                        {{ __('adminlte::adminlte.required_camp') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('adminlte_js')
<script>
		/*
		const  upload_input = document.getElementById('upload-input');
		
		document.querySelector('.upload-btn').addEventListener('click', function() {
			document.getElementById('upload-input').click();
		});
		
		upload_input.onchange = evt => {
			const [file] = upload_input.files;
			if (file) {
				blah.src = URL.createObjectURL(file);
			}
		}
		*/
		
		document.addEventListener("DOMContentLoaded", function() {
			const uploadContainer = document.querySelector('.upload-container');
			const uploadButton = document.querySelector('.upload-btn');
			const uploadInput = document.getElementById('image');
			const uploadText = document.querySelector('.upload-text');
			const uploadImage = document.querySelector('.upload-img img');

			uploadContainer.addEventListener('click', function() {
				uploadInput.click();
			});

			uploadButton.addEventListener('click', function() {
				uploadInput.click();
			});

			uploadInput.addEventListener('change', function(event) {
				const file = event.target.files[0];
				const reader = new FileReader();
				reader.readAsDataURL(file);

				reader.onloadend = function() {
					uploadText.textContent = file.name;
					uploadImage.setAttribute('aria-label', file.name);
					uploadImage.setAttribute('src', reader.result);
				};
			});
		});
		
	</script>
@stop
