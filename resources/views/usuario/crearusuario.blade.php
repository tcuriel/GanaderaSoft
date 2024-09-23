@extends('layouts.page2')

@php
    $cargar_tabs = false;
    $mostrar_instituciones = true;
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

    @vite('resources/sass/app.scss')
    @vite('resources/sass/app/register/styles.scss')

    <!-- Upload style -->    
    <link rel="stylesheet" href=" {{ asset('assets/css/upload.css') }}">

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

        <div class="row" style="width: 90%;padding: 10px;">

            <h2 class="page-title">Crear Usuario</h2>

            <form class="form-app" action="{{ route('storeregister') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="row">

                    {{-- Panel izquierdo --}}
                    <div class="col-sm-4">

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
                    </div>

                    {{-- Panel derecho --}}
                    <div class="col-sm-4">
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
                        </select>

                    </div>

                    {{-- Panel derecho --}}
                    <div class="col-sm-4">
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
                    </div>
                </div>

                <div class="row" style="padding: 20px 0px 0px 0px">

                    {{-- Botones --}}
                    <div class="">
                        <!--div class="row g-0"-->
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-2">
                                {{-- Register button --}}
                                <button type="submit" class="btn btn-secundary2 w-100 mb-3">{{ __('adminlte::adminlte.create_account') }}</button>
                            </div>
                            <label class="col-12 form-label mt-3"><span class="text-danger">(*)</span>
                            {{ __('adminlte::adminlte.required_camp') }}</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@section('js-content')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const uploadContainer = document.querySelector('.upload-container');
        const uploadButton = document.querySelector('.upload-btn');
        const uploadInput = document.getElementById('image');
        const uploadText = document.querySelector('.upload-text');
        const uploadImage = document.querySelector('.upload-img img');

        const handleFile = (file) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onloadend = function() {
            uploadText.textContent = file.name;
            uploadImage.setAttribute('aria-label', file.name);
            uploadImage.setAttribute('src', reader.result);
            };
        };

        // Drag and Drop functionality
        uploadContainer.addEventListener('dragover', (event) => {
            event.preventDefault();
            uploadContainer.classList.add('dragover');
        });

        uploadContainer.addEventListener('dragleave', () => {
            uploadContainer.classList.remove('dragover');
        });

        uploadContainer.addEventListener('drop', (event) => {
            event.preventDefault();
            uploadContainer.classList.remove('dragover');
            handleFile(event.dataTransfer.files[0]);
        });

        uploadButton.addEventListener('click', function() {
            uploadInput.click();
        });

        // Click functionality
        uploadContainer.addEventListener('click', () => {
            uploadInput.click();
        });

        uploadInput.addEventListener('change', () => {
            handleFile(uploadInput.files[0]);
        });
        });
    </script>

@endsection
