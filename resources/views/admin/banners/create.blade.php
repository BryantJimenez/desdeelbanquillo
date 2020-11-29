@extends('layouts.admin')

@section('title', 'Crear Banner')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/css/forms/switches.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/css/forms/theme-checkbox-radio.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Crear Banner / Página Principal</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('banners.store') }}" method="POST" class="form" id="formBannerCreate" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">Título<b class="text-danger">*</b></label>
									<input class="form-control" type="text" name="title" required placeholder="Introduzca un título" value="{{ old('title') }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Destacado<b class="text-danger">*</b></label>
									<select class="form-control" name="featured" required id="banner-type">
										<option value="1" @if(old('featured')=="1") selected @endif>Principal Superior</option>
										<option value="2" @if(old('featured')=="2") selected @endif>Principal Alargado</option>
										<option value="3" @if(old('featured')=="3") selected @endif>Principal Medio</option>
										<option value="4" @if(old('featured')=="4") selected @endif>Principal Inferior</option>
									</select>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Imagen<b class="text-danger">*</b></label>
									<input type="file" name="image" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" />
									<span class="badge badge-primary mt-1"><small class="form-text mt-0" id="text-image-size">La imagen debe tener un tamaño de 1410px de ancho y 500px de alto</small></span>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">¿Desea añadir una url destino? (Opcional)</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<select class="form-control" name="pre_url">
												<option @if(old('pre_url')=="http://") selected @endif>http://</option>
												<option @if(old('pre_url')=="https://") selected @endif>https://</option>
											</select>
										</div>
										<input class="form-control" type="text" name="url" placeholder="www.ejemplo.com/pagina" value="{{ old('url') }}">
									</div>
								</div>

								<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
									<label class="col-form-label">¿Dónde quieres que se vea la url? (Opcional)</label>
									<div class="n-chk">
										<label class="new-control new-radio new-radio-text radio-primary">
											<input type="radio" class="new-control-input" name="target" value="2">
											<span class="new-control-indicator"></span><span class="new-radio-content">Nueva Pestaña</span>
										</label>
									</div>
									<div class="n-chk">
										<label class="new-control new-radio new-radio-text radio-primary">
											<input type="radio" class="new-control-input" name="target" value="1">
											<span class="new-control-indicator"></span><span class="new-radio-content">En la misma Pestaña</span>
										</label>
									</div>
								</div>

								<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Desactivar/Activar Banner<b class="text-danger">*</b></label>
									<div>
										<label class="switch s-icons s-outline s-outline-primary mr-2">
											<input type="checkbox" checked required value="1" id="stateCheckbox">
											<span class="slider round"></span>
											<input type="hidden" name="state" required value="1" id="stateHidden">
										</label>
									</div>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="banner">Guardar</button>
										<a href="{{ route('banners.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection