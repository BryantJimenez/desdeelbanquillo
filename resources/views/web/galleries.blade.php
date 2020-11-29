@extends('layouts.web')

@section('title', 'Galería')

@section('links')
<!-- Lightgallery -->
<link rel="stylesheet" href="{{ asset('/admins/vendor/lightgallery/lightgallery.css') }}">
@endsection

@section('content')

<section class="ftco-section py-0">
	<div class="container bg-white pb-1 pt-2">
		<div class="row">
			<div class="col-12">
				<p><a href="{{ route('home') }}" class="text-danger">Home</a> <i class="fa fa-angle-right"></i> Galería</p>
			</div>

			<div class="col-12">
				<div class="card shadow mb-2">
					<div class="card-body">
						<div class="row">
							<div class="col-12 mb-4">
								<p class="h5 text-red">
									<span class="pr-3 py-3"><img src="{{ asset('/web/img/categorias.png') }}" class="mr-2" alt="categorias" width="35">Categorías:</span> 
									<a href="{{ route('galleries') }}" class="btn @if(is_null($selected)) btn-outline-primary @else btn-primary @endif mr-3 mt-2">Todas</a>
									@foreach($categories as $category)
									@if(count($category->galleries)>0)
									<a href="{{ route('galleries', ['category' => $category->slug]) }}" class="btn @if(!is_null($selected) && $selected==$category->slug) btn-outline-primary @else btn-primary @endif mr-3 mt-2">{{ $category->name }}</a>
									@endif
									@endforeach
								</p>
							</div>

							<div class="col-12">
								<div class="row" id="lightgallery">
									@foreach($galleries as $gallery)
									<a href="{{ asset('/admins/img/galleries/'.$gallery->image) }}" class="galleries-image overflow-hidden position-relative mb-3">
										<img src="{{ asset('/admins/img/galleries/'.$gallery->image) }}" class="w-100" alt="{{ $gallery->title }}">
									</a>
									@endforeach
								</div>
							</div>

							<div class="col-12">
								<nav class="mt-5">
									{{ $pagination->links() }}
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@section('scripts')
<!-- Lightgallery -->
<script type="text/javascript" src="{{ asset('/admins/vendor/lightgallery/lightgallery.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/lightgallery/lg-thumbnail.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/lightgallery/lg-fullscreen.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/lightgallery/lg-zoom.js') }}"></script>
@endsection