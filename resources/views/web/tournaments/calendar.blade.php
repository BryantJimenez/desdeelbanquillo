@extends('layouts.web')

@section('title', $league->title." - Calendario")

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<section class="ftco-section py-0">
	<div class="container bg-white pb-1 pt-2">
		<div class="row">
			<div class="col-12">
				<p><a href="{{ route('home') }}" class="text-danger">Home</a> <i class="fa fa-angle-right"></i> {{ $league->title }} <i class="fa fa-angle-right"></i> Calendario</p>
			</div>

			<div class="col-12 mb-3">
				<div class="row">
					<div class="col-lg-1 col-md-2 col-sm-10 col-12">
						<img src="{{ asset('/web/img/torneo.png') }}" width="90" height="60" alt="Escudo de Ligas">
					</div>

					<div class="col-lg-7 col-md-10 col-sm-10 col-12 mb-2 pl-lg-4">
						<h2 class="h5 text-dark mb-4"><span class="border-orange-dark">{{ $league->title }}</span></h2>
						<div class="tournament-buttons">
							<a href="{{ route('calendar', ['tournament' => $league->slug]) }}" class="btn btn-outline-secondary active text-uppercase font-weight-bold rounded px-lg-3 mr-lg-3 mb-1">Calendario</a>
							<a href="{{ route('classification', ['tournament' => $league->slug]) }}" class="btn btn-outline-secondary text-uppercase font-weight-bold rounded px-lg-3 mr-lg-3 mb-1">Clasificación</a>
							<a href="{{ route('teams', ['tournament' => $league->slug]) }}" class="btn btn-outline-secondary text-uppercase font-weight-bold rounded px-lg-3 mr-lg-3 mb-1">Equipos</a>
							<a href="{{ route('scorers', ['tournament' => $league->slug]) }}" class="btn btn-outline-secondary text-uppercase font-weight-bold rounded px-lg-3 mr-lg-3 mb-1">Pichichi</a>
						</div>
					</div>

					<div class="col-lg-2 col-md-6 col-sm-6 col-12 mb-1">
						<select class="form-control">
							<option>{{ $league->year."/".number_format($league->year+1, 0, "", "") }}</option>
						</select>
					</div>

					<div class="col-lg-2 col-md-6 col-sm-6 col-12 mb-1">
						<select class="form-control" id="selectDayCalendar">
							@foreach($league->days as $days)
							@if($day->state=="1")
							<option @if($days->state=="1") selected @endif value="{{ $days->day }}" tournament="{{ $league->slug }}">Jornada {{ $days->day }}</option>
							@else
							<option @if($days->day==$day->day) selected @endif value="{{ $days->day }}" tournament="{{ $league->slug }}">Jornada {{ $days->day }}</option>
							@endif
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="row bg-light mx-1 px-2 py-2">
					<div class="col-12 border-orange-dark d-none d-lg-block">
						<div class="row">
							<div class="col-lg-1 col-12 d-flex flex-column">
								<img src="{{ asset('/web/img/almanaque.png') }}" class="mx-auto" width="71" height="60">
								<p class="h6 text-dark text-center mb-1">Fecha y Hora</p>
							</div>
							<div class="col-lg-2 col-12 d-flex flex-column">
								<img src="{{ asset('/web/img/equipo1.png') }}" class="mx-auto" width="76" height="76">
								<p class="h6 text-dark text-center mb-1">Equipo 1</p>
							</div>
							<div class="col-lg-3 col-12 d-flex flex-column pt-4">
								<p class="h6 text-dark text-center pt-5 mt-1 mb-1">Resultados</p>
							</div>
							<div class="col-lg-2 col-12 d-flex flex-column">
								<img src="{{ asset('/web/img/equipo2.png') }}" class="mx-auto" width="76" height="76">
								<p class="h6 text-dark text-center mb-1">Equipo 2</p>
							</div>
							<div class="col-lg-2 col-12 d-flex flex-column">
								<img src="{{ asset('/web/img/estadio.png') }}" class="mx-auto" width="102" height="72">
								<p class="h6 text-dark text-center mb-1">Estadio a Jugar</p>
							</div>
							<div class="col-lg-1 col-12 d-flex flex-column">
								<img src="{{ asset('/web/img/goles.png') }}" class="mx-auto" width="59" height="70">
								<p class="h6 text-dark text-center mb-1">Goles</p>
							</div>
						</div>
					</div>

					@forelse ($day->matches as $match)
					<div class="col-12">
						<div class="row pt-2">
							<div class="col-lg-1 col-12 pt-4">
								<p class="h6 text-dark text-center">{{ date('d/m/Y H:i', strtotime($match->date))." hs" }}</p>
							</div>
							<div class="col-lg-2 col-12 pt-4 d-none d-md-block">
								<p class="h6 text-dark text-center">@if(isset($match->teams[0])){{ $match->teams[0]->name }}@else{{ "Desconocido" }}@endif</p>
							</div>
							<div class="col-lg-3 col-12 d-flex justify-content-between">
								<img src="@if(isset($match->teams[0])){{ asset('/admins/img/teams/'.$match->teams[0]->shield) }}@else{{ asset('/admins/img/teams/imagen.jpg') }}@endif" width="65" height="65" class="rounded-circle" alt="@if(isset($match->teams[0])){{ $match->teams[0]->name }}@else{{ "Desconocido" }}@endif">
								<div class="w-50 h-75 mt-2" style="background-image: url('/web/img/fondogoles.png'); background-size: 100% 100%;">
									<p class="h6 font-weight-bold btn d-flex justify-content-between text-white mt-2">
										@if(!isset($match->teams[0]) || !isset($match->teams[1]))
										<span>-</span>
										<span>-</span>
										<span>-</span>
										@elseif(is_null($match->teams[0]->pivot->goals) && is_null($match->teams[1]->pivot->goals))
										<span>-</span>
										<span>-</span>
										<span>-</span>
										@else
										<span>{{ $match->teams[0]->pivot->goals }}</span>
										<span>-</span>
										<span>{{ $match->teams[1]->pivot->goals }}</span>
										@endif
									</p>
								</div>	
								<img src="@if(isset($match->teams[1])){{ asset('/admins/img/teams/'.$match->teams[1]->shield) }}@else{{ asset('/admins/img/teams/imagen.jpg') }}@endif" width="65" height="65" class="rounded-circle" alt="@if(isset($match->teams[1])){{ $match->teams[1]->name }}@else{{ "Desconocido" }}@endif">
							</div>
							<div class="col-lg-2 col-12 pt-4 d-none d-md-block">
								<p class="h6 text-dark text-center">@if(isset($match->teams[1])){{ $match->teams[1]->name }}@else{{ "Desconocido" }}@endif</p>
							</div>
							<div class="col-lg-2 col-12 pt-4">
								<p class="h6 text-dark text-center">{{ $match->stadium->name }}</p>
							</div>
							<div class="col-lg-1 col-12 text-center pt-3">
								@if(!isset($match->teams[0]) || !isset($match->teams[1]))
								<a href="javascript:void(0);" class="btn btn-sm btn-secondary text-white rounded">Ver Goles</a>
								@elseif(is_null($match->teams[0]->pivot->goals) && is_null($match->teams[1]->pivot->goals))
								<a href="javascript:void(0);" class="btn btn-sm btn-secondary text-white rounded">Ver Goles</a>
								@else
								<button type="button" match="{{ $match->slug }}" class="btn btn-sm btn-blue text-white rounded goals">Ver Goles</button>
								@endif
							</div>
							<div class="col-lg-1 col-12 d-flex pt-3">
								@if(isset($match->teams[0]) && isset($match->teams[1]))
								<img src="{{ asset('/web/img/whatsapp.png') }}" class="mx-auto scores" width="45" height="45" match="{{ $match->slug }}" team_one="@if(isset($match->teams[0])){{ $match->teams[0]->name }}@else{{ "Desconocido" }}@endif" team_two="@if(isset($match->teams[1])){{ $match->teams[1]->name }}@else{{ "Desconocido" }}@endif">
								@endif
							</div>
						</div>
					</div>

					<div class="col-12">
						<hr>
					</div>
					@empty
					<div class="col-12">
						<p class="h4 text-danger text-center py-5 my-5">No hay ningun partido en esta jornada</p>
					</div>
					@endforelse
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modalGoals" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Goles del Partido</h5>
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalScore" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="{{ route('goles.store') }}" method="POST" class="modal-content" id="formScore">
			@csrf
			<div class="modal-header">
				<h5 class="modal-title">Goles del Partido</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-lg-6 col-md-6 col-12">
						<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
						<input class="form-control" type="text" name="name" required placeholder="Introduzca su nombre" value="{{ old('name') }}">
					</div>

					<div class="form-group col-lg-6 col-md-6 col-12">
						<label class="col-form-label">Minuto<b class="text-danger">*</b></label>
						<input class="form-control hour" type="text" name="time" required placeholder="Seleccione" min="1" value="1">
					</div>

					<div class="form-group col-lg-6 col-md-6 col-12">
						<label class="col-form-label" id="team_one_score"></label>
						<input class="form-control goals" type="text" name="goals_one" required placeholder="Seleccione los goles" min="0" value="0">
					</div>

					<div class="form-group col-lg-6 col-md-6 col-12">
						<label class="col-form-label" id="team_two_score"></label>
						<input class="form-control goals" type="text" name="goals_two" required placeholder="Seleccione los goles" min="0" value="0">
					</div>
					<input type="hidden" name="match_id" id="match">
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info rounded" action="score">Enviar</button>
				<button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cerrar</button>
			</div>
		</form>
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