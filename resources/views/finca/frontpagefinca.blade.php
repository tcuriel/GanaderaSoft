@extends('layouts.page')

@section('css-content')
    @vite('resources/sass/app/finca/stylefrontpagefinca.scss')
@stop

@section('body-content')
<div-- class="row">
    <div class="col content d-flex flex-column justify-content-center">
        <h2 class="title-blue">¡Hola! {{ $user->name }} vemos que no posees una Finca para gestionarla</h2>
        <p class="text-wellcome">Si deseas crear una Finca, presiona el siguiente botón:</p>
        <a href="{{ route('createmyfarm') }}" type="button" class="btn btn-secundary">Crear Finca</a>
    </div>
</div>
@stop
