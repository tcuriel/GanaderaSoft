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
							<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
								Acción
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
										<td>
											<a href="#" title="Archivar">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
													<path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139q.323-.119.684-.12h5.396z"/>
												</svg>
											</a>
											<a href="#" title="Modificar">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
													<path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
												</svg>
											</a>
											<a href="#" title="Eliminar">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
													<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
													<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
												</svg>
											</a>
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