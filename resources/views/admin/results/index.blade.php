@extends('layouts.admin')

@section('title', 'Resultados de las Jornadas')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/css/forms/switches.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-10 col-md-9 col-12 mt-3">
						<h4>Resultados de las Jornadas</h4>
					</div>
					<div class="col-xl-2 col-md-3 col-12">
						<select class="form-control mt-3" id="select-day">
							@foreach ($tournament->days as $day)
							<option value="{{ $day->slug }}">Jornada {{ $day->day }}</option>
							@endforeach
						</select>
					</div>  
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">
						@foreach ($tournament->days as $day)
						<div class="row mb-4" day="{{ $day->slug }}">
							<div class="col-12 mb-4">
								<p class="h6 text-primary font-weight-bold">
									Jornada {{ $day->day }}
									<label class="switch s-icons s-outline s-outline-primary ml-1 ml-md-5 mb-0">
										<input type="checkbox" @if($day->state=="1") checked @endif value="1" class="stateDayCheckbox" day="{{ $day->slug }}">
										<span class="slider round mt-2"></span>
									</label>
									<span class="small text-black">Jornada activada por default</span>
								</p>
							</div>

							<div class="col-12">
								@foreach($day->matches as $match)
								<div class="row match" match="{{ $match->slug }}">
									<div class="col-12">
										<label class="switch s-icons s-outline s-outline-primary mb-0">
											<input type="checkbox" @if($match->state=="1") checked @endif value="1" class="stateMatchCheckbox" match="{{ $match->slug }}">
											<span class="slider round mt-2"></span>
										</label>
										<span class="text-black">Mostrar en el inicio</span>
									</div>

									<div class="col-lg-4 col-md-4 col-sm-4 col-12">
										<p class="h6 text-black py-2 mb-3">{{ date('d-m-Y H:i', strtotime($match->date))." hs" }}</p>
									</div>

									<div class="col-lg-4 col-md-4 col-sm-4 col-12">
										<p class="h6 text-md-center text-black py-2 mb-3">{{ $match->stadium->name }}</p>
									</div>

									<div class="col-lg-4 col-md-4 col-sm-4 col-12 text-md-right mb-3">
										<button type="button" class="btn btn-primary add-goals" match="{{ $match->slug }}">Añadir Goleadores</button>
									</div>

									<div class="col-lg-3 col-md-2 col-12">
										<p class="h6 text-black d-flex justify-content-between">
											<span class="pr-1 py-2">@if(isset($match->teams[0])){{ $match->teams[0]->name }}@else{{ "Desconocido" }}@endif</span>
											<img src="@if(isset($match->teams[0])){{ asset('/admins/img/teams/'.$match->teams[0]->shield) }}@else{{ asset('/admins/img/teams/imagen.jpg') }}@endif" width="50" height="50" class="rounded-circle" alt="@if(isset($match->teams[0])){{ $match->teams[0]->name }}@else{{ "Desconocido" }}@endif">
										</p>
									</div>

									<div class="col-lg-6 col-md-8 col-12">
										<div class="row">
											<div class="col-lg-5 col-md-5 col-sm-5 col-12">
												<input type="text" class="form-control goals" value="@if(!isset($match->teams[0])){{ "" }}@elseif(is_null($match->teams[0]->pivot->goals)){{ "" }}@else{{ $match->teams[0]->pivot->goals }}@endif" min="0" match="{{ $match->slug }}" team="0">
											</div>

											<div class="col-lg-2 col-md-2 col-sm-2 col-12">
												<p class="h6 font-weight-bold text-danger text-center">VS</p>
											</div>

											<div class="col-lg-5 col-md-5 col-sm-5 col-12">
												<p class="h6 text-black text-right">
													<input type="text" class="form-control goals" value="@if(!isset($match->teams[1])){{ "" }}@elseif(is_null($match->teams[1]->pivot->goals)){{ "" }}@else{{ $match->teams[1]->pivot->goals }}@endif" min="0" match="{{ $match->slug }}" team="1" >
												</p>
											</div>
										</div>
									</div>

									<div class="col-lg-3 col-md-2 col-12">
										<p class="h6 text-black text-right d-flex justify-content-between">
											<img src="@if(isset($match->teams[1])){{ asset('/admins/img/teams/'.$match->teams[1]->shield) }}@else{{ asset('/admins/img/teams/imagen.jpg') }}@endif" width="50" height="50" class="rounded-circle" alt="@if(isset($match->teams[1])){{ $match->teams[1]->name }}@else{{ "Desconocido" }}@endif">
											<span class="pl-1 py-2">@if(isset($match->teams[1])){{ $match->teams[1]->name }}@else{{ "Desconocido" }}@endif</span>
										</p>
									</div>

									<div class="col-12">
										<hr class="border-top-1 border-primary">
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

<div class="modal fade" id="modalGoals" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Selecciona a los goleadores del partido</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-12" id="team-one">
						<p id="team_one_name"></p>
					</div>

					<div class="col-lg-6 col-12" id="team-two">
						<p id="team_two_name"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<p class="h6 text-danger d-none" id="error-goals">Todos los campos son obligatorios</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" match="" id="save_goals">Guardar</button>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection