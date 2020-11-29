@extends('layouts.web')

@section('title', $league->title." - Equipos")

@section('content')

<section class="ftco-section py-0">
	<div class="container bg-white pb-1 pt-2">
		<div class="row">
			<div class="col-12">
				<p><a href="{{ route('home') }}" class="text-danger">Home</a> <i class="fa fa-angle-right"></i> {{ $league->title }} <i class="fa fa-angle-right"></i> Equipos</p>
			</div>

			<div class="col-12 mb-3">
				<div class="row">
					<div class="col-lg-1 col-md-2 col-sm-10 col-12">
						<img src="{{ asset('/web/img/torneo.png') }}" width="90" height="60" alt="Escudo de Ligas">
					</div>

					<div class="col-lg-7 col-md-10 col-sm-10 col-12 mb-2 pl-lg-4">
						<h2 class="h5 text-dark mb-4"><span class="border-orange-dark">{{ $league->title }}</span></h2>
						<div class="tournament-buttons">
							<a href="{{ route('calendar', ['tournament' => $league->slug]) }}" class="btn btn-outline-secondary text-uppercase font-weight-bold rounded px-lg-3 mr-lg-3 mb-1">Calendario</a>
							<a href="{{ route('classification', ['tournament' => $league->slug]) }}" class="btn btn-outline-secondary text-uppercase font-weight-bold rounded px-lg-3 mr-lg-3 mb-1">Clasificación</a>
							<a href="{{ route('teams', ['tournament' => $league->slug]) }}" class="btn btn-outline-secondary active text-uppercase font-weight-bold rounded px-lg-3 mr-lg-3 mb-1">Equipos</a>
							<a href="{{ route('scorers', ['tournament' => $league->slug]) }}" class="btn btn-outline-secondary text-uppercase font-weight-bold rounded px-lg-3 mr-lg-3 mb-1">Pichichi</a>
						</div>
					</div>

					<div class="col-lg-2 col-md-6 col-sm-6 col-12 mb-1">
						<select class="form-control">
							<option>{{ $league->year."/".number_format($league->year+1, 0, "", "") }}</option>
						</select>
					</div>

					<div class="col-lg-2 col-md-6 col-sm-6 col-12 mb-1">
						<select class="form-control">
							@foreach($league->days as $days)
							<option @if($days->state=="1") selected @endif value="{{ $days->day }}" tournament="{{ $league->slug }}">Jornada {{ $days->day }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="row @if(count($league->teams)>0) bg-light @endif mx-1 px-2 py-2">
					@forelse ($league->teams as $team)
					<div class="col-lg-3 col-md-4 col-sm-4 col-6">
						<div class="card bg-light border-0 mb-2">
							<div class="row no-gutters">
								<div class="col-lg-3 col-md-4 col-12 d-flex d-md-block justify-content-center">
									<img src="{{ asset('/admins/img/teams/'.$team->shield) }}" width="65" height="65" class="rounded-circle" alt="{{ $team->name }}">
								</div>
								<div class="col-lg-9 col-md-8 col-12">
									<div class="card-body d-flex flex-column py-1">
										<p class="h6 text-dark text-center text-md-left mb-1">{{ $team->name }}</p>
										<a href="{{ route('players', ['tournament' => $league->slug, 'team' => $team->slug]) }}" class="btn btn-sm btn-blue rounded mx-auto mx-md-0">Ver Jugadores</a>
									</div>
								</div>
							</div>
						</div>
					</div>

					@if($loop->iteration%4==0)
					<div class="col-12 d-none d-lg-block">
						<hr>
					</div>
					@endif

					@if($loop->iteration%3==0)
					<div class="col-12 d-none d-sm-block d-lg-none">
						<hr>
					</div>
					@endif

					@if($loop->iteration%2==0)
					<div class="col-12 d-sm-none">
						<hr>
					</div>
					@endif
					@empty
					<div class="col-12 my-5">
						<p class="h4 text-danger text-center py-5 my-5">No hay ningun equipo en la liga</p>
					</div>
					@endforelse
				</div>
			</div>
		</div>
	</div>
</section>

@endsection