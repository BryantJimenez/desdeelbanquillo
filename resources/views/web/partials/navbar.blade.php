<section class="ftco-section bg-dark-grey-header d-none d-lg-block d-xl-block py-0">
	<div class="container">
		<div class="row">
			<div class="col-6">
				<a href="#"><p class="h6 text-white red-link pt-3"><img src="{{ asset('/web/img/escuchanosenvivo.png') }}"> Escuchanos en Vivo...</p></a>
			</div>
			<div class="col-6">
				<p class="h6 text-right text-white py-3 mb-0 social-links">Nuestras Redes: <a href="#"><img src="{{ asset('/web/img/facebookblanco.png') }}" alt="Facebook" id="facebook"></a> <a href="#"><img src="{{ asset('/web/img/twitterblanco.png') }}" alt="Twitter" id="twitter"></a> <a href="#"><img src="{{ asset('/web/img/instablanco.png') }}" alt="Instagram" id="instagram"></a></p>
			</div>
		</div>
	</div>
</section>
<section class="ftco-section bg-light-grey-header d-none d-lg-block d-xl-block py-0">
	<div class="container">
		<div class="row">
			<div class="col-4 z-index-2">
				<img src="{{ asset('/web/img/imagenmarcas.png') }}" class="w-100 pr-5 mt-4">
			</div>
			<div class="col-4">
				<div class="w-100 bg-light-grey-header d-flex justify-content-center logo-square">
					<a href="{{ route('home') }}"><img src="{{ asset('/web/img/logo.png') }}" width="350" height="110" class="w-75 mx-5 mt-5"></a>
				</div>
			</div>
			<div class="col-4 text-right pt-4 pb-2">
				@guest
				<a class="btn btn-primary rounded text-uppercase font-weight-bold text-white px-5" data-toggle="modal" data-target="#modal-login">Ingresar</a>
				<p class="h6 text-white mt-2 mr-2">Eres Nuevo? <a href="#" id="register" data-toggle="modal" data-target="#modal-register">Registrate</a></p>
				@else
				<a class="nav-link font-weight-bold text-white dropdown-toggle" href="#" id="navbarUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="{{ asset('/admins/img/users/'.Auth::user()->photo) }}" width="55" width="55" class="rounded-circle">
					{{ Auth::user()->name." ".Auth::user()->lastname }}
				</a>
				<div class="dropdown-menu text-lg-center" aria-labelledby="navbarUser">
					<a class="dropdown-item" href="#"><i class="fa fa-cog"></i> Editar Perfil</a>
					<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Cerrar Sesión</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
		<!-- <a class="navbar-brand" href="#">Navbar</a> -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link font-weight-bold text-uppercase" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link font-weight-bold text-uppercase dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Futbol
					</a>
					<div class="dropdown-menu text-lg-center" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Todas las noticias</a>
						<a class="dropdown-item" href="#">Equipos</a>
						<a class="dropdown-item" href="#">Calendario</a>
						<a class="dropdown-item" href="#">Fixture</a>
						<a class="dropdown-item" href="#">Todos los torneos</a>
						<a class="dropdown-item" href="#">Resultados</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link font-weight-bold text-uppercase" href="#">Noticias</a>
				</li>
				<li class="nav-item">
					<a class="nav-link font-weight-bold text-uppercase" href="#">Entrevistas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link font-weight-bold text-uppercase" href="#">Videos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link font-weight-bold text-uppercase" href="#">Galeria</a>
				</li>
				<li class="nav-item">
					<a class="nav-link font-weight-bold text-uppercase" href="#">Premios Deb</a>
				</li>
				<li class="nav-item">
					<a class="nav-link font-weight-bold text-uppercase" href="#">E-Sport</a>
				</li>
			</ul>
			<form class="form-inline border-left border-left-gray pl-lg-2 pl-xl-3" id="form-search">
				<div class="input-group">
					<input class="form-control rounded-pill search-menu" type="search" placeholder="Buscar Noticia">
					<div class="input-group-append">
						<button class="btn btn-sm btn-white" type="button"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</nav>