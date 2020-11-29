<section class="ftco-section bg-dark-grey-header d-none d-lg-block d-xl-block py-0">
	<div class="container">
		<div class="row">
			<div class="col-6">
				<a href="@if(!empty($setting->listen)){{ $setting->pre_url.$setting->listen }}@else{{ 'javascript:void(0);' }}@endif"><p class="h6 text-white red-link pt-3"><img src="{{ asset('/web/img/escuchanosenvivo.png') }}"> Escuchanos en Vivo...</p></a>
			</div>
			<div class="col-6">
				<p class="h6 text-right text-white py-3 mb-0 social-links">Nuestras Redes: <a href="@if(!empty($setting->facebook)){{ $setting->facebook }}@else{{ 'javascript:void(0);' }}@endif"><img src="{{ asset('/web/img/facebookblanco.png') }}" alt="Facebook" id="facebook"></a> <a href="@if(!empty($setting->twitter)){{ $setting->twitter }}@else{{ 'javascript:void(0);' }}@endif"><img src="{{ asset('/web/img/twitterblanco.png') }}" alt="Twitter" id="twitter"></a> <a href="@if(!empty($setting->instagram)){{ $setting->instagram }}@else{{ 'javascript:void(0);' }}@endif"><img src="{{ asset('/web/img/instablanco.png') }}" alt="Instagram" id="instagram"></a></p>
			</div>
		</div>
	</div>
</section>
<section class="ftco-section bg-light-grey-header d-none d-lg-block d-xl-block py-0">
	<div class="container">
		<div class="row">
			<div class="col-4 z-index-2">
				@if(!empty($setting->brands))
				<img src="{{ asset('/admins/img/settings/'.$setting->brands) }}" class="w-100 brands_height pr-5 mt-4">
				@endif
			</div>
			<div class="col-4">
				<div class="w-100 bg-light-grey-header d-flex justify-content-center logo-square">
					<a href="{{ route('home') }}"><img src="{{ asset('/web/img/logo.png') }}" width="350" height="110" class="w-75 mx-5 mt-5 pb-xl-3"></a>
				</div>
			</div>
			<div class="col-4 text-right pt-4 pb-2">
				@if(!session()->has('user'))
				<a class="btn btn-primary rounded text-uppercase font-weight-bold text-white px-5" data-toggle="modal" data-target="#modal-login">Ingresar</a>
				<p class="h6 text-white mt-2 mr-2">Eres Nuevo? <a href="javascript:void(0);" id="register" data-toggle="modal" data-target="#modal-register">Registrate</a></p>
				@else
				<a class="nav-link font-weight-bold text-white dropdown-toggle" href="#" id="navbarUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="{{ asset('/admins/img/users/'.session('user')[0]->photo) }}" width="55" width="55" class="rounded-circle">
					{{ session('user')[0]->name." ".session('user')[0]->lastname }}
				</a>
				<div class="dropdown-menu text-lg-center" aria-labelledby="navbarUser">
					{{-- <a class="dropdown-item" href="#"><i class="fa fa-cog"></i> Editar Perfil</a> --}}
					<a class="dropdown-item" href="{{ route('logout.custom') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Cerrar Sesión</a>
					<form id="logout-form" action="{{ route('logout.custom') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
				@endguest
			</div>
		</div>
	</div>
</section>
<nav class="navbar shadow-dark sticky-top navbar-dark bg-dark-grey-header navbar-expand-lg">
	<div class="container px-0">
		<a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('/web/img/logo.png') }}" class="d-block d-lg-none d-xl-none" width="210" height="47" alt="Logo"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item {{ active('/') }}">
					<a class="nav-link font-weight-bold text-uppercase" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link font-weight-bold text-uppercase dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Futbol
					</a>
					<div class="dropdown-menu futbol-dropdown" aria-labelledby="navbarDropdown">					

						<div class="col-12">
							<div class="row">
								<div class="col-12">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-12 pt-3 pb-5 pb-sm-0 order-1 order-sm-0">
											<a class="text-white font-weight-bold" href="{{ route('news') }}"><p><img src="{{ asset('/web/img/icononoticias.png') }}" alt="Escudo de ligas"> Todas las noticias</p></a>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-12 order-0 order-sm-1 news-image">
											<img src="{{ asset('/web/img/fotonews.png') }}" height="50" class="float-sm-right pt-1" alt="Fondo de noticias">
										</div>
									</div>
								</div>

								<div class="col-12">
									<div class="d-flex tournament-img">
										<img src="{{ asset('/web/img/torneo.png') }}" class="mx-auto">
									</div>
									<div class="line line-top">
										<hr>
									</div>
								</div>

								<div class="col-12">
									<div class="row">
										@foreach($tournaments as $tournament)
										<div class="col-lg-6 col-md-6 col-12 mb-4 mt-1">
											<h5 class="text-red font-weight-bold pl-3 mb-1">{{ $tournament->title }}</h5>
											<div class="d-flex pl-3">
												<a href="{{ route('calendar', ['tournament' => $tournament->slug]) }}" class="text-white font-weight-bold small mr-3">Calendario</a>
												<a href="{{ route('calendar', ['tournament' => $tournament->slug]) }}" class="text-white font-weight-bold small mr-3">Resultados</a>
												<a href="{{ route('classification', ['tournament' => $tournament->slug]) }}" class="text-white font-weight-bold small mr-3">Clasificación</a>
												<a href="{{ route('teams', ['tournament' => $tournament->slug]) }}" class="text-white font-weight-bold small">Equipos</a>
											</div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</li>
				<li class="nav-item {{ active('noticias', 1) }}">
					<a class="nav-link font-weight-bold text-uppercase" href="{{ route('news') }}">Noticias</a>
				</li>
				<li class="nav-item {{ active('noticias/entrevistas') }}">
					<a class="nav-link font-weight-bold text-uppercase" href="{{ route('news', ['category' => 'entrevistas']) }}">Entrevistas</a>
				</li>
				<li class="nav-item {{ active('videos') }}">
					<a class="nav-link font-weight-bold text-uppercase" href="{{ route('videos') }}">Videos</a>
				</li>
				<li class="nav-item {{ active('galeria', 1) }}">
					<a class="nav-link font-weight-bold text-uppercase" href="{{ route('galleries') }}">Galeria</a>
				</li>
				<li class="nav-item {{ active('noticias/premios-deb') }}">
					<a class="nav-link font-weight-bold text-uppercase" href="{{ route('news', ['category' => 'premios-deb']) }}">Premios Deb</a>
				</li>
				<li class="nav-item {{ active('noticias/e-sport') }}">
					<a class="nav-link font-weight-bold text-uppercase" href="{{ route('news', ['category' => 'e-sport']) }}">E-Sport</a>
				</li>
				@if(!session()->has('user'))
				<li class="nav-item d-lg-none">
					<a class="nav-link font-weight-bold text-uppercase" href="javascript:void(0);" data-toggle="modal" data-target="#modal-login">Ingresar</a>
				</li>
				<li class="nav-item d-lg-none">
					<a class="nav-link font-weight-bold text-uppercase" href="javascript:void(0);" data-toggle="modal" data-target="#modal-register">Registrate</a>
				</li>
				@endif
			</ul>
			<form action="{{ route('search') }}" method="GET" class="form-inline border-left border-left-gray pl-lg-2 pl-xl-3" id="form-search">
				<div class="input-group">
					<input class="form-control rounded-pill search-menu" type="search" name="search" placeholder="Buscar Noticia">
					<div class="input-group-append">
						<button class="btn btn-sm btn-white" type="submit"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</nav>