@extends('layouts.page')

@section('css-content')
<style>

    .wrapper{
        display: flex;
        flex-direction: column; /* Arrange flex items vertically (button below div) */
        align-items: center; /* Center flex items horizontally */
    }

    .upload-img{
        max-width: 120px;
        margin-right: auto;
        margin-left: auto;
        position: relative;
    }

    .upload-img img{
        width: 100%;
    }

    .upload-text{
        color: rgba(0, 0, 0, 0.2);
        font-weight: 600;
        margin-top: 12px;
    }

    .upload-container{
        width: 500px;
        border: 2px dashed rgba(0, 0, 0, 0.2);
        border-radius: 6px;
        padding: 28px;
        cursor: pointer;
        transition: all 300ms ease-in-out;
    }

    .upload-container:hover{
        background-color: rgba(253, 59, 132, 0.02);
        border-color: rgba(254, 132, 138, 1);
    }

    .upload-btn{
        background: gray;
        /*background: radial-gradient(circle, rgba(253, 59, 132, 1) 35%, rgba(254, 132, 138, 1) 100%);*/
        border: none;
        font-family: inherit;
        font-size: 17px;
        color: #fff;
        padding: 7px 18px;
        margin-top: 24px;
        border-radius: 5px;
        cursor: pointer;
        /*box-shadow: rgb(200, 41, 102) 0px 8px 10px -11px;*/
        transition: all 0.3s ease-in-out;
    }

    .upload-btn:hover{
        box-shadow: gray 0px 8px 10px -9px;
    }

    .visually-hidden{
        display: none;
    }

    .flex-container {
        display: flex;
        flex-direction: column;
        align-items: center; /* Or flex-start, flex-end */
        justify-content: center; /* Or flex-start, space-between, etc. */
        width: 200px;
    }

    .flex-item {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 5px;
    }

    .left-aligned-item { /* Add this class to the item you want to align left */
        align-self: flex-start;
    }

    </style>
@stop

@section('welcome-user')
    @if (isset($user->name))
        <h2 class="welcome-user">Bienvenido {{ $user->name }}.</h2>
    @endif
@stop

@section('body-content')

    <!--include('usuario.table')-->
            
    <div class="container flex-container d-flex justify-content-center">
        <h2 style="width: 60rem;"><--- Subir Usuarios</h2>
        <div class="card" style="width: 60rem;">
            <div class="card-header">

            </div>
            <div class="card-body">

            <button type = "button" class = "btn btn-secundary upload-btn">Seleccionar Archivos</button>
                <label class="form-label"><span class="text-danger"></span></label>
                <div class = "">
                    <div class = "upload-container">
                        <div class = "upload-img">
                            <img src = "" alt = "" id="blah">
                        </div>
                        <p class = "upload-text">Arrastre y suelte el archivo aquí</p>
                    </div>
                    <div>
                        <input type = "file" name="image" class = "visually-hidden" id = "image">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="disabledSelect" class="form-label">Separación CSV:</label>
                    <select id="disabledSelect" class="form-select">
                        <option>,</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="disabledSelect" class="form-label">Codificación:</label>
                    <select id="disabledSelect" class="form-select">
                        <option>UTF-8</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="disabledSelect" class="form-label">Previsualizar filas:</label>
                    <select id="disabledSelect" class="form-select">
                        <option>10</option>
                    </select>
                </div>

                <div class="col-lg-5">    <!-- class="btn btn-secundary mt-3 mt-lg-0 w-100" -->
                    <button type="submit" class="btn btn-secundary2 btn-230">{{ __('Subir Usuario') }}</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js-content')

@stop
