@extends('layouts.admin')

@section('title', 'Clasificación')

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
						<h4>Clasificación</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Equipo</th>
										<th>PTS</th>
										<th>PJ</th>
										<th>PG</th>
										<th>PE</th>
										<th>PP</th>
										<th>GF</th>
										<th>GC</th>
										<th>DIF</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($positions as $position)
									@foreach($position as $team)
									<tr>
										<td>{{ $num }}</td>
										<td>
											<img src="{{ asset('/admins/img/teams/'.$team['team']->shield) }}" width="55" height="55" class="rounded-circle mr-2" style="border: 3px solid {{ $colors[$num-1]->color }};" alt="{{ $team['team']->name }}">
											{{ $team['team']->name }}
										</td>
										<td>{{ $team['points'] }}</td>
										<td>{{ $team['matches'] }}</td>
										<td>{{ $team['wins'] }}</td>
										<td>{{ $team['draw'] }}</td>
										<td>{{ $team['losses'] }}</td>
										<td>{{ $team['favor'] }}</td>
										<td>{{ $team['against'] }}</td>
										<td>{{ $team['difference'] }}</td>
										<td>
											<div class="btn-group" role="group">
												<button type="button" class="btn btn-primary btn-sm bs-tooltip" title="Cambiar color" onclick="colorModal('{{ $colors[$num-1]->position }}', '{{ $colors[$num-1]->color }}')"><i class="fa fa-palette"></i></button>
											</div>
										</td>
									</tr>
									@php $num++ @endphp
									@endforeach
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

<div class="modal fade" id="modalColors" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{ route('resultados.colors', ['tournament' => $tournament->slug]) }}" method="POST">
				@csrf
				@method('PUT')
				<div class="modal-header">
					<h5 class="modal-title">Cambiar color</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<input type="color" class="form-control" name="color" value="#dddddd" id="color">
							<input type="hidden" name="position" id="position">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Actualizar</button>
				</div>
			</form>
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