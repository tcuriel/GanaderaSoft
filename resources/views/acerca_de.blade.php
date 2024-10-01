@extends('layouts.pageAdministrar')

@php
    $cargar_tabs = false;
    $mostrar_instituciones = true;
    $mostrar_estrella_solitaria = false;
    $mostrar_lateral = false;
    $mostrar_btn_inicio_sesion = true;
@endphp

@section('classes_body')
    row
    g-0
    min-vh-100
@endsection

@section('css-content')

    @vite('resources/sass/app/wellcome/styles.scss')

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

@section('instituciones')
    <!--div class="instituciones"-->
        <img src="{{ asset('images/ucv 1.svg') }}" alt="">
        <img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
        <img src="{{ asset('images/fagro.svg') }}" alt="">
        <img src="{{ asset('images/Fonacit 1.svg') }}" alt="">
    <!--/div-->
@endsection

@section('barra2')

    <div class="nav2-container">
        {{-- Tabs --}}
        <div class="item nav2-tabs-container">
            <ul id="abas" class="teste">
                @if($cargar_tabs)
                    <li class="selecionada">
                        <a id="aba_1" href="#aba_1" onclick="event.preventDefault()">
                        </a>
                    </li>
                    <li>
                        <a id="aba_2" href="#aba_2" onclick="event.preventDefault()">
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        {{-- Botón (Inicio de Sesión) --}}
        <div class="item nav2-btn-container">
            @if($mostrar_btn_inicio_sesion)
                <a href="{{ route('login') }}"
                    type="button"
                    class="btn btn-clear2 btn-230 btn-lg"
                    style="justify-content: right;align-items: right;">
                    Inicio de Sesión
                </a>
            @endif
        </div>

    </div>

@endsection

@section('barra3')

@endsection

@section('lateral')

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: transparent;">
    <!-- Sidebar -->
    <div class="sidebar" style="background-color: transparent;">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('register')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modificar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Eliminar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Archivar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-users"></i>
              <p>
                Subir usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('register')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subir</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      </div>
    <!-- /.sidebar -->
  </aside>

@endsection

@section('contenido')

    <div id="conteudos" class="conteudos">

        <div id="conteudo_1" class="conteudo visivel">

            <div class=""
                    style="display: flex;
                          justify-content: center;
                          align-items: center;
                          padding: 0; /* Elimina padding interno */
                          margin: 0; /* Elimina margin interno */">
                <img src="{{ asset('images/VACA-1 1.svg') }}"
                        alt="Logo GSoft"
                        style="width: 257px;height: 258px;padding: 0px;">
            </div>

            <div class="texto-responsive"
                 style="padding: 15px 10px 10px 10px;border: 1px solid #CCCCCC;border-radius: 10px;">
                <p>
                    <span style="font-weight: bold;">Sistema Web para la Gestión de los Datos Productivos en la Ganadería Vacuna GanaderaSoft</span> es un proyecto</br>
                    de investigación desarrollado en la Universidad Central de Venezuela en las
                    <br>
                    Facultades de Ciencias y Agronomía, con el propósito de sistematizar y automatizar los procesos la producción bovina.
                </p>
                <p>
                    <span style="font-weight: bold;">Financiado por el Fondo Nacional de Ciencia, Tecnología e Innovación,
                    Ministerio del Poder Popular para Ciencia y Tecnología (MINCYT).</span>
                </p>
                <p>
                <span style="font-weight: bold;">Investigadores principales:</span>
                <br>
                Profa. Yosly Hernández Bieliukas. Ciencias UCV<br>
                Profa. Marina Fuentes. Agronomía UCV<br>
                Prof. Daniel Vargas. Agronomía UCV
                </p>
                <p>
                <span style="font-weight: bold;">Equipo de desarrollo:</span>
                <br>
                Aux Docente Juan Luis Fernández,<br>
                Br. Pedro Leal, <br>
                Prof. Tirzo Curiel. Desarrolladores<br>
                Aux Docente Carlos Leal<br>
                </p>
            </div>

        </div>

        <div id="conteudo_2" class="conteudo">
            <p>Conteúdo da Aba 2</p>
        </div>

    </div>

@endsection
