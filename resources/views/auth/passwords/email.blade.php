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

	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

    <!-- App style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href=" {{ asset('assets/css/style-new2.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style-tabs.css') }}">
    <!--link rel="stylesheet" href="{{ asset('assets/css/Styles.css') }}"-->

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #666
        }

        body {
            background-image: url('/images/fondo_GS.png');
            /*opacity: 0.5; /* Adjust opacity as needed */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Adjust height as needed */
        }
	</style>
    
@stop

@section('auth_body')

<section class="home">

    <div class="navbarx image-container">
        <img src="{{ asset('images/ucv 1.svg') }}" alt="">
        <img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
        <img src="{{ asset('images/fagro.svg') }}" alt="">
        <img src="{{ asset('images/Fonacit 1.svg') }}" alt="">
    </div>

    <div class="cover">
        <div class="content-mail">
            <div class="content-email-head" >
                <img src="{{ asset('images/VACA-1 1.svg') }}" class="centrado" alt="">
                <h1 class="primary-title primary-title-shadow centrado">{{ __('GanaderaSoft') }}</h1>
            </div>

            <p class="content-email-message">
                Ingresa el correo electrónico registrado.<br>
                Te enviaremos un correo con las instruccines<br>
                para reestablecer tu contraseña
            </p>

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

                {{-- Login field --}}
                <div class="contenedor-botones">

                    <div class="margin-auto">
                        {{-- Send reset link button --}}
                        <button type="submit" class="boton-email">
                            <!--span class="fas fa-share-square"></span-->
                            {{ __('Enviar correo electrónico') }}
                        </button>
                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="footer">
        <img src="{{ asset('images/Group 36861.svg') }}" alt="">
        <span>GanaderaSoft 2024</span>
    </div>

</section>

<!--script src="{{ asset('js/app.js') }}"></script-->

@stop
