@extends('layouts.page')
<!--
@section('css-content')
    @vite('resources/sass/app/finca/formcreatefinca.scss')
@stop -->

@section('body-content')
    @include('reproduccion.formcreatereproduccion')
@stop

@section('js-content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
@stop
