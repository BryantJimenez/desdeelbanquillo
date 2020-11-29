@extends('layouts.admin')

@section('title', 'Editar Ajutes')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Editar Ajustes</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('ajustes.update', ['slug' => $setting->slug]) }}" method="POST" class="form" id="formSetting" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
									<label class="col-form-label">Facebook (Opcional)</label>
									<input class="form-control" type="text" name="facebook" placeholder="https://www.facebook.com/pagina" value="{{ $setting->facebook }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
									<label class="col-form-label">Instagram (Opcional)</label>
									<input class="form-control" type="text" name="instagram" placeholder="https://www.instagram.com/pagina" value="{{ $setting->instagram }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
									<label class="col-form-label">Twitter (Opcional)</label>
										<input class="form-control" type="text" name="twitter" placeholder="https://www.twitter.com/pagina" value="{{ $setting->twitter }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
									<label class="col-form-label">Primer Email (Opcional)</label>
									<input class="form-control" type="email" name="email_one" placeholder="Introduce un email" value="{{ $setting->email_one }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
									<label class="col-form-label">Segundo Email (Opcional)</label>
									<input class="form-control" type="email" name="email_two" placeholder="Introduce un email" value="{{ $setting->email_two }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
									<label class="col-form-label">Escuchanos en Vivo (Opcional)</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<select class="form-control" name="pre_url">
												<option @if($setting->pre_url=="http://") selected @endif>http://</option>
												<option @if($setting->pre_url=="https://") selected @endif>https://</option>
											</select>
										</div>
										<input class="form-control" type="text" name="listen" placeholder="www.ejemplo.com/pagina" value="{{ $setting->listen }}">
									</div>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Imagen de Marcas (Opcional)</label>
									<input type="file" name="brands" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ '/admins/img/settings/'.$setting->brands }}" />
									<span class="badge badge-primary mt-1"><small class="form-text mt-0" id="text-image-size">La imagen debe tener un tamaño de 400px de ancho y 72px de alto</small></span>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="setting">Actualizar</button>
									</div>
								</div> 
							</div>
						</form>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection