@extends('layouts.admin')

@section('title', 'Jornadas del Torneo')

@section('links')
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Jornadas del torneo "{{ $tournament->title }}"</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">
						@foreach ($tournament->days as $day)
						<div class="row mb-4" day="{{ $day->slug }}">
							<div class="col-12">
								<p class="h6 text-primary font-weight-bold">Jornada {{ $day->day }}</p>
							</div>
							
							<div class="form-group col-lg-3 col-md-3 col-sm-6 col-12">
								<label class="col-form-label">Fecha y Hora</label>
								<input class="form-control time-flatpickr" type="text" placeholder="Fecha y Hora" day="{{ $day->slug }}">
							</div>

							<div class="form-group col-lg-3 col-md-3 col-sm-6 col-12">
								<label class="col-form-label">Equipo 1</label>
								<select class="form-control first_team_id" day="{{ $day->slug }}">
									<option value="">Seleccione</option>
									@foreach($tournament->teams as $team)
									<option value="{{ $team->slug }}">{{ $team->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-lg-3 col-md-3 col-sm-6 col-12">
								<label class="col-form-label">Equipo 2</label>
								<select class="form-control second_team_id" day="{{ $day->slug }}">
									<option value="">Seleccione</option>
									@foreach($tournament->teams as $team)
									<option value="{{ $team->slug }}">{{ $team->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-lg-2 col-md-3 col-sm-6 col-12">
								<label class="col-form-label">Estadio</label>
								<select class="form-control stadium_id" day="{{ $day->slug }}">
									<option value="">Seleccione</option>
									@foreach($stadiums as $stadium)
									<option value="{{ $stadium->slug }}">{{ $stadium->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-lg-1 col-12 pt-4">
								<buttom class="btn btn-success add_match" day="{{ $day->slug }}"><i class="fa fa-plus"></i></buttom>
							</div>

							<div class="col-12 days" day="{{ $day->slug }}">
								@foreach($day->matches as $match)
								<div class="row match" match="{{ $match->slug }}">
									<div class="col-lg-3 col-md-3 col-sm-6 col-12">
										<p class="h6 text-black">{{ date('d-m-Y H:i', strtotime($match->date))." hs" }}</p>
									</div>

									<div class="col-lg-5 col-md-5 col-sm-6 col-12">
										<p class="h6 text-black text-lg-center">@if(isset($match->teams[0])){{ $match->teams[0]->name }}@else{{ "Desconocido" }}@endif <b class="text-danger">VS</b> @if(isset($match->teams[1])){{ $match->teams[1]->name }}@else{{ "Desconocido" }}@endif</p>
									</div>

									<div class="col-lg-3 col-md-3 col-sm-5 col-11">
										<p class="h6 text-black">{{ $match->stadium->name }}</p>
									</div>

									<div class="col-1">
										<p class="h6 text-danger text-lg-center text-right" onclick="deleteMatch('{{ $match->slug }}');"><i class="fa fa-trash"></i></p>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						@endforeach

						<div class="row">
							<div class="form-group col-12">
								<div class="btn-group" role="group">
									<a href="{{ route('torneos.index', ['tournament' => $tournament->slug]) }}" class="btn btn-secondary">Volver</a>
								</div>
							</div> 
						</div>
					</div>
				</div>                                        
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="deleteMatch" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres eliminar este partido?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancelar</button>
				<form action="#" method="POST" id="formDeleteMatch">
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
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection