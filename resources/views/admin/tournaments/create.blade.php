@extends('layouts.admin')

@section('title', 'Crear Ligas')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Crear Ligas</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('torneos.store') }}" method="POST" class="form" id="formTournament">
							@csrf
							<div class="row">
								<div class="form-group col-lg-8 col-md-6 col-12">
									<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
									<input class="form-control" type="text" name="title" required placeholder="Introduzca un nombre" value="{{ old('title') }}">
								</div>

								<div class="form-group col-lg-4 col-md-4 col-12">
									<label class="col-form-label">Año<b class="text-danger">*</b></label>
									<select class="form-control" name="year" required>
										<option value="">Seleccione</option>
										@for ($i = 2020; $i < 2051; $i++)
											<option value="{{ $i }}" @if($i==old('year')) selected @endif>{{ $i }}</option>
										@endfor
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Jornadas<b class="text-danger">*</b></label>
									<select class="form-control" name="days" required>
										<option value="">Seleccione</option>
										@for ($i = 1; $i < 51; $i++)
											<option value="{{ $i }}" @if($i==old('days')) selected @endif>{{ $i }}</option>
										@endfor
									</select>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="tournament">Guardar</button>
										<a href="{{ route('torneos.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection