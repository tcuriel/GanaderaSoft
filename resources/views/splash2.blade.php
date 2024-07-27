@extends('adminlte::master')

@section('adminlte_css')
    <!--vite(['resources/sass/app.scss', 'resources/sass/app/wellcome/styles.scss'])-->
    <!-- App style -->
    <!--link rel="stylesheet" href=" // asset('assets/css/style.css') }}"-->
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .splash-screen {
            text-align: center;
        }

        /* ... (Existing CSS styles remain the same) ... */

        .splash-screen img {
            /* ... (Existing styles remain the same) ... */
            position: absolute; /* Make the image absolute */
            top: 50%; /* Position the top to 50% */
            left: 50%; /* Position the left to 50% */
            transform: translate(-50%, -50%); /* Center the image */
        }

        /* ... (Existing CSS styles remain the same) ... */

        .splash-screen-title {
            /* ... (Existing styles remain the same) ... */
            position: absolute; /* Make the title absolute */
            bottom: 100px; /* Position the bottom at 20px */
            left: 50%; /* Position the left to 50% */
            transform: translateX(-50%); /* Center the title horizontally */
            font-size: 42pt;
            color: #148FBE; 
        }

        /* ... (Existing CSS styles remain the same) ... */

        footer {
            position: fixed; /* Fix the footer to the bottom */
            bottom: 0; /* Place it at the absolute bottom */
            width: 100%; /* Span the full width of the viewport */
            background-color: #f8f9fa; /* Set a background color */
            padding: 20px; /* Add some padding for spacing */
            text-align: left; /* Center the content */
            color: #148FBE;
            
        }

        .footer-container {
            /* ... (Existing styles remain the same) ... */
            max-width: 1440px; /* Limit the width for better readability */
            margin: 0 auto; /* Center the container horizontally */
        }
    </style>
@endsection

@section('body')
    <!--div id="splash-screen">
        <div class="splash-container">
            <img src="{{ asset('images/VACA-1_1.png') }}" alt="{{ config('app.name') }} Logo">
            <p class="splash-screen-title">GanaderaSoft</p> 
        </div>
    </div-->

    <div id="splash-screen" class="splash-screen">
        <img src="{{ asset('images/VACA-1_1.png') }}" alt="Application Logo">
        <p class="splash-screen-title">{{ 'GanaderaSoft' }}</p>
    </div>

    <footer>
        <div class="footer-container">
            <p>&copy; Copyright GanaderaSoft 2024</p>
        </div>
    </footer>

    <!--script src="{{ asset('js/app.js') }}"></script-->

    <script>
        // Set timeout for splash screen display
        setTimeout(() => {
            document.getElementById('splash-screen').classList.add('fade-out');

            // Redirect to the next page after fade-out animation completes
            setTimeout(() => {
                window.location.href = "{{ route('welcome') }}";
            }, 1000); // Adjust the delay for redirect as needed
        }, 1000); // Adjust the display time for the splash screen as needed
    </script>
@endsection
