@extends('layouts.web')

@section('title', $league->title." - Clasificación")

@section('content')

<section class="ftco-section py-0">
	<div class="container bg-white pb-1 pt-2">
		<div class="row">
			<div class="col-12">
				<p><a href="{{ route('home') }}" class="text-danger">Home</a> <i class="fa fa-angle-right"></i> {{ $league->title }} <i class="fa fa-angle-right"></i> Clasificación</p>
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
							<a href="{{ route('classification', ['tournament' => $league->slug]) }}" class="btn btn-outline-secondary active text-uppercase font-weight-bold rounded px-lg-3 mr-lg-3 mb-1">Clasificación</a>
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
						<select class="form-control" id="selectDayClassification">
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
				<div class="row mx-1 px-2 py-2">
					@if(count($positions)>0)
					<table class="table-positions table table-striped table-borderless" cellspacing="0" width="100%">
						<thead>
							<tr class="text-white">
								<th class="font-weight-bold border-left-blue py-0">Equipo</th>
								<th class="font-weight-bold py-0">PTS</th>
								<th class="font-weight-bold py-0">PJ</th>
								<th class="font-weight-bold py-0">PG</th>
								<th class="font-weight-bold py-0">PE</th>
								<th class="font-weight-bold py-0">PP</th>
								<th class="font-weight-bold py-0">GF</th>
								<th class="font-weight-bold py-0">GC</th>
								<th class="font-weight-bold py-0">DIF</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($positions as $position)
							@foreach($position as $team)
							<tr>
								<td class="h5 text-left pl-1" style="border-left: 6px solid {{ $colors[$num]->color }} !important;">
									<img src="{{ asset('/admins/img/teams/'.$team['team']->shield) }}" width="55" height="55" class="rounded-circle ml-4 mr-2" alt="{{ $team['team']->name }}">
									{{ $team['team']->name }}
								</td>
								<td class="h4 font-weight-bold text-dark">{{ $team['points'] }}</td>
								<td class="h4 font-weight-bold text-dark">{{ $team['matches'] }}</td>
								<td class="h4 font-weight-bold text-dark">{{ $team['wins'] }}</td>
								<td class="h4 font-weight-bold text-dark">{{ $team['draw'] }}</td>
								<td class="h4 font-weight-bold text-dark">{{ $team['losses'] }}</td>
								<td class="h4 font-weight-bold text-dark">{{ $team['favor'] }}</td>
								<td class="h4 font-weight-bold text-dark">{{ $team['against'] }}</td>
								<td class="h4 font-weight-bold text-dark">{{ $team['difference'] }}</td>
							</tr>
							@php $num++ @endphp
							@endforeach
							@endforeach
						</tbody>
					</table>
					@else
					<div class="col-12 my-5">
						<p class="h4 text-danger text-center py-5 my-5">No hay ningun equipo en la liga</p>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>

@endsection