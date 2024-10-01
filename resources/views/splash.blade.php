@extends('adminlte::master')

@section('adminlte_css')

    <!--vite(['resources/sass/app.scss', 'resources/sass/app/wellcome/styles.scss'])-->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

    <!-- App style -->
    <!--link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"-->
    <link rel="stylesheet" href=" {{ asset('assets/css/style-new2.css') }}">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
@endsection

@section('body')

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url()->previous() }}";
                }
            });
        </script>
    @endif

    <!--section class="home"-->

        <div class="instituciones">
            <img src="{{ asset('images/ucv 1.svg') }}" alt="">
            <img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
            <img src="{{ asset('images/fagro.svg') }}" alt="">
            <img src="{{ asset('images/Fonacit 1.svg') }}" alt="">
        </div>

        <div class="cover">

            <div id="splash-screen" class="title-splash" >
                <img src="{{ asset('images/VACA-1 1.svg') }}"
                     alt="Logo GSoft">
                <p>GanaderaSoft</p>
            </div>

        </div>

        <div class="footer">
            <img src="{{ asset('images/Group 36861.svg') }}" alt="">
            <span>GanaderaSoft 2024</span>
        </div>

    <!--/section-->

    <!--script src="{{ asset('js/app.js') }}"></script-->

    <script>
        //import Swal from 'sweetalert2';
        // Set timeout for splash screen display
        setTimeout(() => {
            document.getElementById('splash-screen').classList.add('fade-out');

            // Redirect to the next page after fade-out animation completes
            setTimeout(() => {
                window.location.href = "{{ route('welcome') }}";
            }, 1000); // Adjust the delay for redirect as needed
        }, 3000); // Adjust the display time for the splash screen as needed
    </script>
@endsection
