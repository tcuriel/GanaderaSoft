@extends('adminlte::master')

@section('adminlte_css')
    @vite('resources/sass/app.scss')
    @vite('resources/sass/app/login/styles.scss')

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">  

    <link href="{{ asset('assets/css/bootstrap.min53c.css') }}"  rel="stylesheet">

    <script src="{{ asset('assets/js/bootstrap53.bundle.min.js') }}"></script>

    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href=" {{ asset('assets/css/style-new.css') }}">
@stop

@section('body')

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
            
                <p class="splash-screen-message font-24 fw-500">
                    ¡El correo elctrónico ha sido enviado!    
                </p>

            </div>

            <p class="content-email-message width-550">
                Te hemos enviado un correo electrónico a tu dirección<br>
                coninstrucciones sobre cómo reestablecer tu contraseña.<br>
                Si no lo recibes en unos minutos comprueba que has usado<br>
                la dirección correcta registrada en GanaderaSoft e<br>
                inténtalo nuevamente, o ponte en contacto con nosotros para<br>
                obtener ayuda.
            </p>

            {{-- Login field --}}
            <div class="contenedor-botones">
                
                <div class="margin-auto">
                    {{-- Send reset link button --}}
                    <button type="submit" class="boton-email">
                        <!--span class="fas fa-share-square"></span-->
                        {{ __('Iniciar Sesión') }}
                    </button>
                </div>

            </div>

        </div>

        <!--a href="{{ route('login') }}" type="button" class="btn btn-clear2 btn-400" style="font-weight: bold;">Iniciar Sesión</a-->
        
    </div>

    <div class="footer">
        <img src="{{ asset('images/Group 36861.svg') }}" alt="">
        <span>GanaderaSoft 2024</span>
    </div>

</section>

<!--script src="{{ asset('js/app.js') }}"></script-->
    
@endsection