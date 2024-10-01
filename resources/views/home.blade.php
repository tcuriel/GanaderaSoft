@extends('layouts.pageFinal')

@section('title', env('APP_NAME', 'GanaderoSoft'))

@section('content_css')
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
 
	@yield('css-content')

@endsection



@section('content_header')
 	<h1 class="m-0 gren-text-color">Bienvenido a {{$data[0]->Nombre}}</h1>
@stop

@section('content')
    @if($section == "finca")
        @include('finca.home')
    @elseif($section == 'animal')
        @include('animal.home')
    @elseif($section == 'produccion')
        @include('produccion.home')
    @elseif($section == 'reproduccion')
		@include('reproduccion.home')
    @elseif($section == 'sanidad')
        <p>Sanidad</p>
    @elseif($section == 'reporte')
        <p>Reporte</p>
    @endif
@stop

@section('content_js')

    @if($selectView == "rebano")
      <!--script src="{{ asset('assets/fcm/src/grid.js') }}"></script-->
      <script type="module" src="{{ asset('assets/fcm/src/index.js') }}"></script>
    @endif
    
    <script>
        let navItems = document.querySelectorAll('.nav-pills .nav-link');
        let sectionName = "{{$section}}";
        let viewName = "{{$selectView}}";
        let navItem = document.getElementById(sectionName + 'Section');
        if (navItem) {
            const navLink = navItem.querySelector('.nav-link');
            navLink.classList.add('active');
        }
        for (const navItem of navItems) {
            const href = navItem.getAttribute('href');
            navItem.setAttribute('href', href + "/{{ $data[0]->id_Finca }}" );
        }
    </script>

    @yield('js-content-home')

@stop
