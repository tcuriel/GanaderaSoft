@extends('adminlte::master')

@section('adminlte_css')
    @vite('resources/sass/app.scss')
    @vite('resources/sass/app/login/styles.scss')
    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href=" {{ asset('assets/css/stylex.css') }}">
    
@endsection

@section('body')
    <div class="container">
        <img src="{{ asset('images/VACA-1_1.png') }}" alt="Image" class="centered">
        <p class="splash-screen-title centered">{{ 'GanaderaSoft' }}</p>
        <p class="splash-screen-message centered">{{ '¡Has cerrado sesión exitosamente!' }}</p>
        <a href="{{ route('login') }}" type="button" class="btn btn-secundary2 btn-230" style="font-weight: bold;">Inicio</a>

    </div>
@endsection
