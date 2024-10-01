@extends('adminlte::master')

@php
    //$section = "finca";
    //$selectView = "rebano";
    //$selectorViews = config('app.finca-selector-view');
@endphp

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('title', env('APP_NAME', 'GanaderoSoft'))

@section('adminlte_css')
    @vite(['resources/sass/app.scss'])
    @vite(['resources/sass/app/ganadegasof.scss'])
    @vite(['resources/sass/app/home/homestyle.scss'])
    @if($section == "finca")
        @vite(['resources/sass/app/finca/homefinca.scss'])
    @elseif($section == "animal")
        @vite(['resources/sass/app/animal/homeanimal.scss'])
    @endif
    <!-- App style -->
    <link rel="stylesheet" href="{{ asset('assets/fcm/learning-ui-kit.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fcm/src/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fcm/node_modules/frappe-charts/dist/frappe-charts.min.css') }}" />

    <style>
        *{
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          color: #666
        }

        body {
          /*background-image: url('/images/fondo_GS.png');
          /*opacity: 0.5; /* Adjust opacity as needed */
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;
          height: 100vh; /* Adjust height as needed */
        }

        aside {
          background-color: #E6F4E7;
        }

        .tarjeta {
          /*background-color: #E6F4E7;*/
          /*border: 0px;*/
          background-color: #c4d741; /* Slightly lighter shade */
          opacity: 0.8; /* Adjust opacity as needed */
        }

        .bg-transparent{
          background-color: transparent;
          border: 0px;
        }

        .bg-aside{
          background-color: #61b5d5; /* Slightly lighter shade */
          opacity: 0.8; /* Adjust opacity as needed */
        }
        .main-header {
          background-color: #218EBC;
          height: 105px; /* Ajusta el valor deseado */
        }
        .main-header {
          background-color: #218EBC;
          height: 105px; /* Ajusta el valor deseado */
        }
        .brand-image {
            background-color: #fff;
            width: 100px;
            height: 100px;
            max-height: 100px;
            /*opacity: 0.5; /* Adjust opacity as needed */
        }
        .brand-link {
            /*background-color: gray;*/
            position: fixed;
            top: 15px;
            left: 25px;
            color: #000;
            text-decoration: none;
            opacity: 0.7; /* Adjust opacity as needed */
        }

        .brand-text {
            background-color: #fff;
            /*opacity: 0.5; /* Adjust opacity as needed */
            color: #000;
        }

        .opciones{
          position: fixed;
          top: 150px;
          left: 5px;
        }

        .label {
          width: 462px;
          height: 77px;
          /*background-color: gray;*/
          position: fixed;
          top: 25px;
          left: 200px;;
        }

        .label .text-wrapper {
          width: 462px;
          -webkit-text-stroke: 1px #148fbe;
          font-family: "Poppins", Helvetica;
          font-weight: 300;
          color: #ffffff;
          font-size: 60px;
          letter-spacing: 0;
          line-height: normal;
        }

    </style>
 
	@yield('css-content')

@endsection

@section('classes_body')
	sidebar-mini
@endsection

@section('content_header')
 	<h1 class="m-0 gren-text-color">Bienvenido a {{$data[0]->Nombre}}</h1>
@endsection

@section('body')

  {{-- Preloader Animation --}}
  @if($layoutHelper->isPreloaderEnabled())
      @include('adminlte::partials.common.preloader')
  @endif

  <div class="wrapper">
  
    <!--div class="preloader flex-column justify-content-center align-items-center">
      <img src="http://ganaderasoft.com/images/VACA-1_1.png"
            class="animation__shake"
            alt="AdminLTE Preloader Image"
            width="183"
            height="183">
    </div-->
    
    <nav class="main-header navbar navbar-expand">

      <ul class="navbar-nav">
        <li class="nav-item" style="position: relative;left: 600px;top: 0;">
          <!--a class="nav-link" data-widget="pushmenu" href="#">
            <i class="fas fa-bars"></i>
            <span class="sr-only">Alternar barra de navegación</span>
          </a-->

          <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="sidebar-toggle-button">
            <i class="fas fa-bars"></i>
          </a>

          <!--button class="hamburger-button">
            <i class="fas fa-bars hamburger-icon"></i>
          </button-->

          <!--av class="navbar">
          
          </nav-->

        </li>
      </ul>
      
      <ul class="navbar-nav ml-auto">
        <!--li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li-->
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="http://ganaderasoft.com/storage/images/user.png" class="user-image img-circle elevation-2" alt="Tirzo">
            <span  class="d-none d-md-inline" >
                Tirzo
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <li class="user-footer">
              <a class="btn btn-default btn-flat float-right  btn-block "
                href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off text-red"></i>
                Salir
              </a>
              <form id="logout-form" action="http://ganaderasoft.com/logout" method="POST" style="display: none;">
                <input type="hidden" name="_token" value="r66k4Zmj12miMeM4DH2uqxRIiLL3J5V2avhgBugR" autocomplete="off">
              </form>
            </li>
          </ul>
        </li>
      </ul>
      
    </nav>

    <aside class="main-sidebar sidebar-blue-primary">
      <a href="http://ganaderasoft.com/home" class="brand-link">
        <img src="http://ganaderasoft.com/images/logo-vaca-1-1.png" 
             alt="" 
             class="brand-image img-circle elevation-3" 
             style="position: relative;z-index: 1;width: 100px;height: 100px;max-height: 100px;">
        <!--span class="brand-text font-weight-light ">
          GanaderaSoft
        </span-->
      </a>

      <div class="label"><div class="text-wrapper">GanaderaSoft</div></div>

      <div class="sidebar">
      
        <nav class="pt-2 opciones">
    
          <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">

            <li  id="fincaSection"  class="nav-item">
              <a class="nav-link "href="http://ganaderasoft.com/dashboard/finca/finca">
                <i class="ico ico_farm "></i>
                <p>
                  Finca
                </p>
              </a>
            </li>

            <li  id="animalSection"  class="nav-item">
              <a class="nav-link "href="http://ganaderasoft.com/dashboard/animal/animal">
              <i class="ico ico_cow "></i>
                <p>
                  Animal
                </p>
              </a>
            </li>

            <li  id="produccionSection"  class="nav-item">
              <a class="nav-link "href="http://ganaderasoft.com/dashboard/produccion/produccion">
                <i class="ico ico_production "></i>
                <p>
                  Producción
                </p>
              </a>
            </li>

            <li  id="reproduccionSection"  class="nav-item">
              <a class="nav-link "href="http://ganaderasoft.com/dashboard/reproduccion/reproduccion">
                <i class="ico ico_reproduction "></i>
                <p>
                  Reproducción
                </p>
              </a>
            </li>

            <li  id="sanidadSection"  class="nav-item">
              <a class="nav-link "href="http://ganaderasoft.com/dashboard/sanidad/sanidad">
                <i class="ico ico_health "></i>
                <p>
                  Sanidad
                </p>
              </a>
            </li>
            
            <li  id="reporteSection"  class="nav-item">
              <a class="nav-link  "href="http://ganaderasoft.com/dashboard/reporte/reporte">
                <i class="ico ico_notes "></i>
                <p>
                  Reporte
                </p>
              </a>
            </li>
            
          </ul>
          
        </nav>
        
      </div>
      
    </aside>

    <div class="content-wrapper xbg-transparentx">
      <div class="content-header">
        <div class="container-fluid">
              <!--h1 class="m-0 gren-text-color">Bienvenido a data[0]-&gt;Nombre</h1-->
              @yield('content_header')
        </div>
      </div>

      <div class="content">
        <div class="xbg-transparentx">
        
          <div class="wrapper d-flex flex-column justify-content-center">

            <!--yield('body-content')-->

            @include('finca.home')

          </div>

        </div>
      </div>
    </div>
  </div>

@endsection

@section('adminlte_js')

	<script src="http://ganaderasoft.com/vendor/adminlte/dist/js/adminlte.min.js"></script>

	<!--script src="http://ganaderasoft.com/vendor/jquery/jquery.min.js"></script-->
	<!--script src="http://ganaderasoft.com/vendor/bootstrap/js/bootstrap.bundle.min.js"></script-->
	<!--script src="http://ganaderasoft.com/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script-->
	<!--script src="http://ganaderasoft.com/vendor/adminlte/dist/js/adminlte.min.js"></script-->

	<!--script src="http://ganaderasoft.com/assets/fcm/src/grid.js"></script-->
  <!--script type="module" src="http://ganaderasoft.com/assets/fcm/src/index.js"></script-->
    
  <script>
      let navItems = document.querySelectorAll('.nav-pills .nav-link');
      let sectionName = "finca";
      let viewName = "rebano";
      let navItem = document.getElementById(sectionName + 'Section');
      if (navItem) {
          const navLink = navItem.querySelector('.nav-link');
          navLink.classList.add('active');
      }
      for (const navItem of navItems) {
          const href = navItem.getAttribute('href');
          navItem.setAttribute('href', href + "/999" );
      }
  </script>

	<script>
  
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarToggleButton = document.getElementById('sidebar-toggle-button');
      const body = document.querySelector('body');

      sidebarToggleButton.addEventListener('click', function() {
        body.classList.toggle('sidebar-collapse');
      });
    })
  
  </script>

  <script>
    /*
    const hamburgerButton = document.querySelector('.hamburger-button');
    const navbar = document.querySelector('.sidebar');

    hamburgerButton.addEventListener('click', () => {
      navbar.classList.toggle('navbar-open');  

    });
    */
  </script>

  @yield('js-content')

@endsection
