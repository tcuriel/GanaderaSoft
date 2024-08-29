@extends('layouts.page2')

@php
    $cargar_tabs = true;
    $mostrar_instituciones = true;
    $mostrar_estrella_solitaria = false;
    $mostrar_lateral = true;
    $mostrar_btn_inicio_sesion = false;
@endphp

@section('classes_body')
    row
    g-0
    min-vh-100
@endsection

@section('css-content')

    @vite('resources/sass/app/wellcome/styles.scss')

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
            <h2>Administrar Sistema GanaderaSoft</h2>

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
                <a href="{{route('crearusuario')}}" class="nav-link">
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

        <div class="conteudos_tabs">

            <ul id="abas" class="teste">
                <li class="selecionada">
                    <a id="aba_1" href="#aba_1" onclick="event.preventDefault()">
                    </a>
                </li>
                <li>
                    <a id="aba_2" href="#aba_2" onclick="event.preventDefault()">
                    </a>
                </li>
            </ul>

        </div>

        <div id="conteudo_1" class="conteudo visivel">

            <p>Conteúdo da Aba 1</p>

        </div>

        <div id="conteudo_2" class="conteudo">

            <p>Conteúdo da Aba 2</p>

        </div>

    </div>

@endsection

@section('js-content')

    <!-- Bootstrap 4 -->
    <!--script src="{{-- asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') --}}"></script-->
    <!-- AdminLTE App -->
    <!--script src="{{-- asset('assets/dist/js/adminlte.min.js') --}}"></script-->
    <!-- AdminLTE for demo purposes -->
    <!--script src="{{-- asset('assets/dist/js/demo.js') --}}"></script-->

    @endsection
