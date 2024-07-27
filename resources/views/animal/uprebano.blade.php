@extends('layouts.page')

@section('css-content')
    @vite('resources/sass/app/animal/uprebano.scss')
@stop

@section('body-content')
	<div class="row g-3">
	  <div class="col-12">
	        <form method="post" action="{{config('app.action-post-urls.up_file_animal')}}" id="herd_file_form">
                @csrf
                <div class="row g-3">
                    <div class="col-12 d-flex flex-wrap g-15">
                        <label
                            type="text"
                            for="herdFile"
                            class="form-label"><span>(*)</span> Seleccionar Archivo</label>
                        <div class="col">
                            <div class="files">
                                <input type="file" id="herdFile" class="form-control" multiple=false>
                            </div>
                        </div>
                        <span id="herdFile-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                    </div>
                    <div class="col-12 d-flex flex-wrap g-15">
                        <label type="text"
                        for="separator"
                        class="form-label"><span>(*)</span> Separador CSV</label>
                        <select class="form-select w-auto"
                        id="separator"
                        name="separator"
                        aria-label="select type separator"
                        required>
                            <option hidden value="" class="placeholder-style">Separador CSV</option>
                            <option value=",">Coma</option>
                            <option value=".">Punto</option>
                            <option value=" ">Espacio</option>
                        </select>
                        <span id="separator-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                    </div>
                    <div class="col-12 d-flex flex-wrap g-15">
                        <label type="text"
                        for="coding"
                        class="form-label">Codificación</label>
                        <select class="form-select w-auto"
                        id="coding"
                        name="coding"
                        aria-label="select type coding"
                        required>
                        <option value="UTF-8">UTF-8</option>
                        </select>
                    </div>
                    <div class="col-12 d-flex flex-wrap">
                        <button type="button" class="action back mx-sm-3 my-1 my-sm-0 btn btn-primary">Regresar</button>
                        <button type="button" class="action submit mx-sm-3 my-1 my-sm-0 btn btn-secundary">Subir Animales</button>
                    </div>
                </div>
          </form>
	  </div>
	</div>
@stop

@section('js-content')
    <script>
        window.dataFinca = '{!! json_encode($data) !!}';
        window.datarebano = '{!! json_encode($datarebano) !!}';
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @vite('resources/js/animal/uprebano.js')
@stop
