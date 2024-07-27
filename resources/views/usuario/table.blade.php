<div class="container d-flex justify-content-center">
<div class="card" style="width: 100rem;">
	<div class="card-header">
        <h2><b>{{ $userData['message'] }}</b>: {{ $tipo }}</h2>
	</div>
	<div class="card-body">
		<!--table id="fincas" class="table table-striped table-bordered" style="width:100%"-->
        <table id="usuarios" class="table table-striped nowrap" style="width:100%">
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
</div>
