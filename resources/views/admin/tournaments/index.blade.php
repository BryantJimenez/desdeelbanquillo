@extends('layouts.admin')

@section('title', 'Lista de Ligas')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Lista de Ligas</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						<div class="text-right">
							<a href="{{ route('torneos.create') }}" class="btn btn-primary">Agregar</a>
						</div>

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Posición en Botonera</th>
										<th>Nombre del Torneo</th>
										<th>Año</th>
										<th>Jornadas</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach($tournaments as $tournament)
									<tr>
										<td>{{ $num++ }}</td>
										<td class="d-flex">
											@if($tournament->position!=$loop->count)
											<form action="{{ route('torneos.down', ['slug' => $tournament->slug]) }}" method="POST">
												@csrf
												@method('PUT')
												<button type="submit" class="btn btn-danger btn-sm rounded-circle bs-tooltip" title="Bajar"><i class="fa fa-arrow-down"></i></button>
											</form>
											@endif
											@if($tournament->position>1)
											<form action="{{ route('torneos.up', ['slug' => $tournament->slug]) }}" method="POST">
												@csrf
												@method('PUT')
												<button type="submit" class="btn btn-success btn-sm rounded-circle bs-tooltip" title="Subir"><i class="fa fa-arrow-up"></i></button>
											</form>
											@endif
										</td>
										<td>{{ $tournament->title }}</td>
										<td>{{ $tournament->year }}</td>
										<td>{{ $tournament->day }}</td>
										<td>
											<div class="btn-group" role="group">
												<a href="{{ route('torneos.edit', ['slug' => $tournament->slug]) }}" class="btn btn-info btn-sm bs-tooltip" title="Editar"><i class="fa fa-edit"></i></a>
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="Eliminar" onclick="deleteTournament('{{ $tournament->slug }}')"><i class="fa fa-trash"></i></button>
												<a href="{{ route('jornadas.index', ['tournament' => $tournament->slug]) }}" class="btn btn-success btn-sm bs-tooltip" title="Jornadas"><i class="fa fa-calendar"></i></a>
												<a href="{{ route('resultados.index', ['tournament' => $tournament->slug]) }}" class="btn btn-dark btn-sm bs-tooltip" title="Resultados de las Jornada"><i class="fa fa-trophy"></i></a>
												<a href="{{ route('equipos.index', ['tournament' => $tournament->slug]) }}" class="btn btn-light btn-sm bs-tooltip" title="Equipos"><i class="fa fa-users"></i></a>
												<a href="{{ route('resultados.classification', ['tournament' => $tournament->slug]) }}" class="btn btn-secondary btn-sm bs-tooltip" title="Tabla de Posiciones"><i class="fa fa-list"></i></a>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

</div>

<div class="modal fade" id="deleteTournament" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres eliminar esta liga?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancelar</button>
				<form action="#" method="POST" id="formDeleteTournament">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-primary">Eliminar</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/jszip.min.js') }}"></script>    
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.print.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
@endsection