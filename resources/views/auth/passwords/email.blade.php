@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@php( $password_email_url = View::getSection('password_email_url') ?? config('adminlte.password_email_url', 'password/email') )

@if (config('adminlte.use_route_url', false))
    @php( $password_email_url = $password_email_url ? route($password_email_url) : '' )
@else
    @php( $password_email_url = $password_email_url ? url($password_email_url) : '' )
@endif

<!-----section('auth_header', __('adminlte::adminlte.password_reset_message'))-->

@section('adminlte_css')
    @vite('resources/sass/app.scss')
    @vite('resources/sass/app/login/styles.scss')
    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">
    
    <link rel="stylesheet" href=" {{ asset('assets/css/stylex.css') }}">
    <style>
    .containerx {
        text-align: center;
    }
    </style>
@stop

@section('auth_body')
    <div class="containerx">
        <img src="{{ asset('images/VACA-1_1.png') }}" alt="Image" class="centered">
        <p class="centered" style="font-size: 24pt;font-weight: bold;color: #148FBE;">{{ 'GanaderaSoft' }}</p>
        <p class="centered" style="font-size: 10pt;font-weight: bold;color: #000000;">
            Ingresa el correo electrónico registrado.<br>
            Te enviaremos un correo con las instruccines<br>
            para reestablecer tu contraseña
        </p>
    </div> 
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
            <script>
                window.location.href = "{{ route('password.emailsent')}}";
            </script>
        </div>
    @endif

    <form action="{{ $password_email_url }}" method="post">
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

        <div class="containerx">
            {{-- Send reset link button --}}
            <button type="submit" class="btn btn-clear2 btn-230">
                <!--span class="fas fa-share-square"></span-->
                {{ __('Enviar correo electrónico') }}
            </button>
        </div> 

    </form>

@stop