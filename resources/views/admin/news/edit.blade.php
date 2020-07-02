@extends('layouts.admin')

@section('title', 'Editar Noticia')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/css/forms/switches.css') }}">
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
						<h4>Editar Noticia</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('noticias.update', ['slug' => $new->slug]) }}" method="POST" class="form" id="formNewEdit" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">Título<b class="text-danger">*</b></label>
									<input class="form-control" type="text" name="title" required placeholder="Introduzca un título" value="{{ $new->title }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Imagen<b class="text-danger">*</b></label>
									<input type="file" name="image" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ '/admins/img/news/'.$new->image }}" />
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Introducción<b class="text-danger">*</b></label>
									<textarea class="form-control" required name="summary" placeholder="Introduce el copete de la noticia" rows="5">{{ $new->summary }}</textarea>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Noticia Ampliada<b class="text-danger">*</b></label>
									<textarea class="form-control" required name="content" placeholder="Introduce el contenido de la noticia" id="content-news" rows="3">{{ $new->content }}</textarea>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Video (Opcional)</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">https://www.youtube.com/watch?v=</span>
										</div>
										<input type="text" class="form-control" name="video" placeholder="FCcrB1ZXYQM" value="{{ $new->video }}">
									</div>
								</div>

								<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Desactivar/Activar Comentarios<b class="text-danger">*</b></label>
									<div>
										<label class="switch s-icons s-outline s-outline-primary mr-2">
											<input type="checkbox" @if($new->state==1) checked @endif required value="1" id="commentCheckbox">
											<span class="slider round"></span>
											<input type="hidden" name="comments" required value="@if($new->state==1) {{ "1" }} @else {{ "0" }} @endif" id="commentHidden">
										</label>
									</div>
								</div>

								<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Categoría<b class="text-danger">*</b></label>
									<select class="form-control" name="category_id" required>
										<option value="">Seleccione</option>
										@foreach($categories as $category)
										<option value="{{ $category->slug }}" @if($category->id==$new->category_id) selected @endif>{{ $category->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Destacado (Opcional)</label>
									<select class="form-control" name="featured">
										<option value="">Seleccione</option>
										<option value="1" @if($new->type=="1") selected @endif>Súper Destacado</option>
										<option value="2" @if($new->type=="2") selected @endif>Destacado Principal</option>
										<option value="3" @if($new->type=="3") selected @endif>Destacado Secundario</option>
									</select>
								</div>

								<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Estado<b class="text-danger">*</b></label>
									<select class="form-control" name="state" required>
										<option value="1" @if($new->state=="1") selected @endif>Publicado</option>
										<option value="3" @if($new->state=="2") selected @endif>Borrador</option>
									</select>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="new">Actualizar</button>
										<a href="{{ route('noticias.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection