@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css')
    @vite('resources/sass/app.scss')
    @vite('resources/sass/app/login/styles.scss')
    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_body')

    <div class="logo-app"></div>
    <h1 class="primary-title primary-title-shadow">{{ config('app.name') }}</h1>
    
    <div class="col-lg-12"> 
        <img src="images/Continuar con Google.png" alt="">
    </div>

    <form class="form-app" action="{{ $login_url }}" method="post">
        @csrf

        {{-- Email field --}}
        <label for="email"
            class="form-label">Correo Electrónico</label>
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

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
        <label for="password"
            class="form-label">Contraseña</label>
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

        {{-- Login field --}}
        <div class="row">
        <div class="col-lg-7"> 
    {{-- Password reset link --}}   <!-- class="btn btn-clear w-100" -->
    <a href="{{ route('password.request') }}" type="button" class="btn btn-clear2">
    {{ __('adminlte::adminlte.reset_password') }}
</a>
</div>


            <!--crearfincadiv-- class=" col-lg-5">
                <a href="{{ route('register') }}" type="button" class="btn btn-primary w-100">
                {{ __('adminlte::adminlte.create_account') }}</a>
            </!--div-->
            <div class="col-lg-5">    <!-- class="btn btn-secundary mt-3 mt-lg-0 w-100" -->
                <button type="submit" class="btn btn-secundary2 btn-300">{{ __('adminlte::adminlte.sign_in') }}</button>
            </div>
        </div>

    </form>
@stop


