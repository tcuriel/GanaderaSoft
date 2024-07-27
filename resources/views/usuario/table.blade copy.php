@extends('adminlte::master')

@section('adminlte_css')
    @vite('resources/sass/app.scss')
    @vite('resources/sass/app/login/styles.scss')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap53.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.css') }}">
	<!--link rel="stylesheet" href="{{ asset('assets/css/responsive.bootstrap4.css') }}"-->
    <!-- App style -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href=" {{ asset('assets/css/stylex.css') }}">
    
@endsection

@section('body')
<div class="card">
	<div class="card-header">

	</div>
	<div class="card-body">

		<table id="fincas" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>e-mail</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Id Personal</th>
                </tr>
            </thead>
                
            <tbody>
                @php
                    $i = 0;
                    //echo "<pre>";
                    //print_r($userData['data']);
                    //echo "</pre>";
                @endphp
                @foreach ($userData['data'] as $usuario)
                    @php
                        $i++;
                        $usuario = (object)$usuario;
                    @endphp
                    <tr>
                        <td>
                            {{ $usuario->id }}
                        </td>
                        <td>
                            {{ $usuario->email }}
                        </td>
                        <td>
                            {{ $usuario->Nombre }}
                        </td>
                        <td>
                            {{ $usuario->Apellido }}
                        </td>
                        <td>
                            {{ $usuario->Telefono }}
                        </td>
                        <td>
                            {{ $usuario->id_Personal }}
                        </td>           
                    </tr>
                @endforeach
            </tbody>
	    </table>
	</div>
</div>
@endsection

@section('adminlte_js')
	<!--script src="{{ asset('assets/js/popper.min.js') }}"></script-->
	<script src="{{ asset('assets/js/dataTables.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap53.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/js/dataTables.bootstrap5.js') }}"></script>
	<!--script src="{{ asset('assets/js/responsive.bootstrap4.js') }}"></script-->
	<script>
		//new DataTable('#fincas');
		var table = new DataTable('#fincas', {
    		language: {
        		url: "{{ asset('assets/json/es-MX.json') }}",
   			},
			responsive: true,
			autoWidth: false,
            pageLength: 10,
            searching: true
		});
	</script>
@endsection
