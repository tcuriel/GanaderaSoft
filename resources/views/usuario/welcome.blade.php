@extends('layouts.page')

@section('css-content')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap53.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.css') }}">
@stop

@section('welcome-user')
    @if (isset($user->name))
        <h2 class="welcome-user">Bienvenido {{ $user->name }}.</h2>
    @endif
@stop

@section('body-content')
  @include('usuario.table')
@stop

@section('js-content')
	<!--script src="{{ asset('assets/js/popper.min.js') }}"></script-->
	<script src="{{ asset('assets/js/dataTables.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap53.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/js/dataTables.bootstrap5.js') }}"></script>
	<script src="{{ asset('assets/js/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('assets/js/responsive.bootstrap5.js') }}"></script>

	<script>
		//new DataTable('#fincas');
		var table = new DataTable('#usuarios', {
    		language: {
        		url: "{{ asset('assets/json/es-MX.json') }}",
   			},
			responsive: true,
			autoWidth: false,
            pageLength: 10,
            searching: true
		});

	</script>
@stop
