@extends('adminlte::page')

@section('css-content')
    @vite('resources/sass/app/finca/stylewelcomefarm.scss')
@stop

@section('welcome-user')
    <h2 class="welcome-user">Bienvenido {{ $user->name }}.</h2>
@stop

@section('body-content')
  <!--include('finca.formwelcomefarms')-->
  Her, soy yo, soy yo,...
@stop

@section('js-content')
    @vite('resources/js/finca/welcomefincaform.js')
@stop
