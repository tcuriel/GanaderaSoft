<div class="card">
	<div class="card-header" style="background-color: #5AB0D1;">
			<h2><b>{{ $userData['message'] }}</b>: {{ $tipo }}</h2>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

		<!--div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="dt-buttons btn-group flex-wrap">               
					<button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button">
						<span>Copy</span>
					</button> 
					<button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button">
						<span>CSV</span>
					</button> <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button">
						<span>Excel</span>
					</button> 
					<button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button">
						<span>PDF</span></button> 
					<button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button">
						<span>Print</span>
					</button> 
					<div class="btn-group">
						<button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="example1" type="button" aria-haspopup="true" aria-expanded="false">
							<span>Column visibility</span>
							<span class="dt-down-arrow"></span>
						</button>
					</div> 
				</div>
			</div>
		</div-->

		<div class="row">
			<div class="col-sm-12">
				<table id="usuarios" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
					<thead>
						<tr>
							<th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
								Id
							</th>
							<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
								e-mail
							</th>
							<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
								Nombre
							</th>
							<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
								Imagen
							</th>
							<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
								Tipo
							</th>
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
											<img src="{{ asset('storage/images/' . $usuario->Imagen) }}" 
												 width=50px 
												 alt="{{ $usuario->Imagen }}">
										</td>
										<td>
												{{ $usuario->Tipo }}
										</td>		 
								</tr>
						@endforeach
					
					</tbody>
					<tfoot>
					
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<!-- /.card-body -->
</div>