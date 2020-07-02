@extends('layouts.admin')

@section('title', 'Inicio')

@section('links')
<link href="{{ asset('/admins/vendor/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Inicio</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-xl-5 col-12 mb-3"> 
						<div class="d-flex justify-content-start text-white card-left-radius border-solid border-width-5px border-grey"> 
							<div class="rounded-circle border-solid border-width-5px border-grey">
								<img src="{{ asset('/admins/img/logoredondo.png') }}" width="90" height="90" alt="Logo">
							</div>
							<div class="py-2">
								<p class="h5 text-primary font-weight-bold pl-2">Bienvenido:</p>
								<p class="pl-2">Administre toda su empresa de forma simple, fácil, comoda y a medida!</p>
							</div>
						</div>
					</div>

					<div class="offset-xl-1 col-xl-3 col-md-6 col-sm-6 col-12 mb-3"> 
						<div class="d-flex justify-content-start text-white card-left-radius border-solid border-width-5px border-grey"> 
							<div class="rounded-circle border-solid border-width-5px border-grey">
								<img src="{{ asset('/admins/img/icons/news.png') }}" width="90" height="90" alt="Noticias">
							</div>
							<div class="py-2">
								<p class="h5 font-weight-bold pl-2">Noticias</p>
								<p class="h3 font-weight-bold text-primary text-center pl-2">32</p>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-md-6 col-sm-6 col-12 mb-3"> 
						<div class="d-flex justify-content-start text-white card-left-radius border-solid border-width-5px border-grey"> 
							<div class="rounded-circle border-solid border-width-5px border-grey">
								<img src="{{ asset('/admins/img/icons/usuarios.png') }}" width="90" height="90" alt="Usuarios">
							</div>
							<div class="py-2">
								<p class="h5 font-weight-bold pl-2">Usuarios</p>
								<p class="h3 font-weight-bold text-success text-center pl-2">320</p>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
						<div class="widget widget-chart-two">
							<div class="widget-heading">
								<h5 class="">Categorías más Visitadas</h5>
							</div>
							<div class="widget-content">
								<div id="chart-2" class=""></div>
							</div>
						</div>
					</div>

					<div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
						<div class="widget widget-chart-one">
							<div class="widget-heading">
								<h5 class="">Visitas Semanales</h5>
								<ul class="tabs tab-pills">
									<li><a href="javascript:void(0);" id="tb_1" class="tabmenu">Monthly</a></li>
								</ul>
							</div>

							<div class="widget-content">
								<div class="tabs tab-content">
									<div id="content_1" class="tabcontent"> 
										<div id="revenueMonthly"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('/admins/js/dashboard/dash_1.js') }}"></script>
@endsection