@extends('adminlte::master')

@section('adminlte_css')

    <!--vite(['resources/sass/app.scss', 'resources/sass/app/wellcome/styles.scss'])-->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

    <!-- App style -->
    <!--link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"-->
    <link rel="stylesheet" href=" {{ asset('assets/css/style-new2.css') }}">

@endsection

@section('body')

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
