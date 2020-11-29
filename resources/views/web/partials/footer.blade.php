<footer class="page-footer font-small bg-grey-footer pt-3">
		<div class="container text-center text-md-left">
			<div class="row mt-3">
				<div class="offset-md-1 offset-lg-2 offset-xl-2 col-md-2 col-lg-3 col-xl-2 col-12 mb-4">
					<a href="{{ route('home') }}"><img src="{{ asset('/web/img/logopequenopiedepagina.png') }}" class="w-100 mb-4" alt="Logo"></a>
					<div class="d-flex justify-content-center justify-content-lg-start justify-content-xl-start">
						<a href="@if(!empty($setting->facebook)){{ $setting->facebook }}@else{{ 'javascript:void(0);' }}@endif" class="btn btn-secondary rounded-0 bg-light-grey-header border-0 mr-2"><i class="fa fa-facebook"></i></a>
						<a href="@if(!empty($setting->twitter)){{ $setting->twitter }}@else{{ 'javascript:void(0);' }}@endif" class="btn btn-secondary rounded-0 bg-light-grey-header border-0 mr-2"><i class="fa fa-twitter"></i></a>
						<a href="@if(!empty($setting->instagram)){{ $setting->instagram }}@else{{ 'javascript:void(0);' }}@endif" class="btn btn-secondary rounded-0 bg-light-grey-header border-0 mr-2"><i class="fa fa-instagram"></i></a>
					</div>
				</div>

				<div class="col-md-4 col-lg-3 col-xl-3 col-12 mx-auto mb-4">
					{{-- <h6 class="text-uppercase font-weight-bold text-white">Últimas Noticias</h6>
					<hr class="deep-yellow mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">

					<div class="pb-2">
						<a href="#"><p class="h6 text-uppercase font-weight-bold text-white red-link">Which team will win the world championship series this year?</p></a>
						<p class="h6 border-bottom pb-3"><small class="text-muted font-weight-bold text-uppercase"> <i class="fa fa-clock-o mr-2"></i> April 15, 2020</small></p>
					</div>

					<div class="pb-2">
						<a href="#"><p class="h6 text-uppercase font-weight-bold text-white red-link">After seven days off, Lebron James and Cavs Rout Raptors</p></a>
						<p class="h6 pb-3"><small class="text-muted font-weight-bold text-uppercase"> <i class="fa fa-clock-o mr-2"></i> April 15, 2020</small></p>
					</div> --}}

				</div>

				<div class="col-md-4 col-lg-3 col-xl-3 col-12 mx-auto mb-md-0 mb-4">
					<h6 class="text-uppercase font-weight-bold text-white">Contactános</h6>
					<hr class="deep-yellow mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">

					<div class="d-flex justify-content-center justify-content-md-start justify-content-lg-start justify-content-xl-start pb-2">
						<img src="{{ asset('/web/img/imagenpiedepagina2.png') }}" class="mt-n-1" width="60" height="60" alt="Icono de Equipo">
						<div class="ml-3">
							<p class="h6 text-uppercase font-weight-bold text-muted mb-0">Contactános</p>
							<a @if(!empty($setting->email_one)) href="mailto:{{ $setting->email_one }}" @endif class="mb-0 pb-3"><small class="text-white">@if(!empty($setting->email_one)){{ $setting->email_one }}@endif</small></a>
						</div>
					</div>

					<div class="d-flex justify-content-center justify-content-md-start justify-content-lg-start justify-content-xl-start pb-2">
						<img src="{{ asset('/web/img/imagenpiedepagina.png') }}" class="mt-n-1" width="60" height="60" alt="Icono de Correo">
						<div class="ml-3">
							<p class="h6 text-uppercase font-weight-bold text-muted mb-0">Contactános</p>
							<a @if(!empty($setting->email_two)) href="mailto:{{ $setting->email_two }}" @endif class="mb-0 pb-3"><small class="text-white">@if(!empty($setting->email_two)){{ $setting->email_two }}@endif</small></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>