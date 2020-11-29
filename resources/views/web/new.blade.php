@extends('layouts.web')

@section('title', $new->title)

@section('ogtype', 'article')
@section('ogdescription', $new->summary)
@section('ogimage', asset('/admins/img/news/'.$new->image))

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/jssocials/jssocials.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/jssocials/jssocials-theme-flat.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<section class="ftco-section py-0">
	<div class="container bg-white pb-1 pt-2">
		<div class="row">
			<div class="col-12">
				<p><a href="{{ route('home') }}" class="text-danger">Home</a> <i class="fa fa-angle-right"></i> <a href="{{ route('news') }}" class="text-danger">Noticias</a> <i class="fa fa-angle-right"></i> <a href="{{ route('news', ['category' => $new->categories[0]->slug]) }}" class="text-danger">{{ $new->categories[0]->name }}</a> <i class="fa fa-angle-right"></i> {{ $new->title }}</p>
			</div>

			<div class="col-xl-9 col-lg-8 col-12">
				<div class="card shadow mb-2">
					<div class="card-body">
						<h5 class="card-title text-muted font-arial notice-title">{{ $new->title }}</h5>

						<div class="d-md-flex justify-content-md-between font-arial notice-social">
							<p class="w-sm-100 pt-2"><i class="fa fa-calendar"></i> Publicado el {{ $new->created_at->format('d/m/Y') }}</p>

							<div class="w-sm-100 d-flex">
								<p class="text-md-right py-2 pr-2">Compartir esta Noticia:</p>
								<div id="social"></div>
							</div>
						</div>

						<img src="{{ asset('/admins/img/news/'.$new->image) }}" class="w-100 mb-2" alt="{{ $new->title }}">

						<p class="card-text font-arial notice-content">{{ $new->summary }}</p>
						
						@if(!empty($banner_middle))
						<div class="py-1">
							@empty($banner_middle->url)
							<img src="{{ asset('/admins/img/banners/'.$banner_middle->image) }}" class="d-block w-100 banner_width_height" alt="{{ $banner_middle->title }}">
							@else
							<a href="{{ $banner_middle->pre_url.$banner_middle->url }}" @if($banner_middle->target==2) target="_blank" @endif><img src="{{ asset('/admins/img/banners/'.$banner_middle->image) }}" class="d-block w-100 banner_width_height" alt="{{ $banner_middle->title }}"></a>
							@endempty
						</div>
						@endif

						<p class="card-text font-arial notice-content">{!! $new->content !!}</p>
					</div>
				</div>

				@if(!empty($new->video))
				<div class="card shadow mb-2">
					<div class="card-body">
						<h5 class="card-title text-muted font-weight-bold text-uppercase"><i class="fa fa-play-circle-o text-red border-left-red"></i> Video de la noticia</h5>

						<iframe class="w-100" height="350" src="{{ youtubeUrl($new->video) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
				@endif

				@if($new->comment==1)
				<div class="card shadow mb-4">
					<div class="card-body" id="comments-card">
						<h5 class="card-title text-muted font-weight-bold text-uppercase"><i class="fa fa-comment-o text-blue border-left-blue"></i> Comentarios de la noticia</h5>

						@include('admin.partials.errors')

						<form class="mb-3">
							<div class="form-group">
								<textarea class="form-control" name="text" placeholder="Comparte tú opinión" rows="3" required>{{ old('text') }}</textarea>
								<input type="hidden" name="news_id" value="{{ $new->slug }}">
								<p class="text-danger font-weight-bold my-1 d-none" id="commentsErrors"></p>
							</div>
							<div class="form-group d-flex justify-content-end">
								@if(session('user'))
								<button type="button" class="btn btn-info rounded px-5" action="comment" id="comment-button">Publicar</button>
								@else
								<button type="button" class="btn btn-info rounded px-5" data-toggle="modal" data-target="#modal-login">Publicar</button>
								@endif
							</div>
						</form>

						@foreach($new->comments as $comment)
						@if($comment->state==1)
						<div class="border-top py-3">
							<div class="d-flex justify-content-start">
								<img src="{{ asset('/web/img/imagencomentarionoticia.png') }}" width="50" height="50" alt="Icono de Comentario">
								<div class="text-muted ml-3">
									<p class="h6 font-weight-bold mb-0">{{ $comment->user->name." ".$comment->user->lastname }}</p>
									<p class="mb-0"><small>{{ $comment->created_at->diffForHumans() }}</small></p>
								</div>
							</div>
							<p class="h6 font-weight-bold text-dark">{{ $comment->text }}</p>
						</div>
						@endif
						@endforeach
					</div>
				</div>
			</div>
			@endif

			<div class="col-xl-3 col-lg-4 col-12">
				@if(!empty($banner_top))
				<div class="pb-3">
					@empty($banner_top->url)
					<img src="{{ asset('/admins/img/banners/'.$banner_top->image) }}" class="d-block w-100 banner_middle_height" alt="{{ $banner_top->title }}">
					@else
					<a href="{{ $banner_top->pre_url.$banner_top->url }}" @if($banner_top->target==2) target="_blank" @endif><img src="{{ asset('/admins/img/banners/'.$banner_top->image) }}" class="d-block w-100 banner_middle_height" alt="{{ $banner_top->title }}"></a>
					@endempty
				</div>
				@endif

				@if(count($related_news)>0)
				<p class="h5 font-weight-bold border-bottom mt-4">También te puede interesar</p>

				@foreach($related_news as $new)
				<div class="card border-0 mt-3 mb-2">
					<a href="{{ route('new', ['category' => $new->categories[0]->slug, 'slug' => $new->slug]) }}"><img src="{{ asset('/admins/img/news/'.$new->image) }}" class="card-img-top rounded-0" alt="{{ $new->title }}"></a>
					<div class="card-body px-0 pt-2">
						<a href="{{ route('new', ['category' => $new->categories[0]->slug, 'slug' => $new->slug]) }}"><h5 class="card-title font-weight-bold">{{ $new->title }}</h5></a>
					</div>
				</div>
				@endforeach
				@endif

				@if(!empty($banner_bottom))
				<div class="py-2">
					@empty($banner_bottom->url)
					<img src="{{ asset('/admins/img/banners/'.$banner_bottom->image) }}" class="d-block w-100 banner_middle_height" alt="{{ $banner_bottom->title }}">
					@else
					<a href="{{ $banner_bottom->pre_url.$banner_bottom->url }}" @if($banner_bottom->target==2) target="_blank" @endif><img src="{{ asset('/admins/img/banners/'.$banner_bottom->image) }}" class="d-block w-100 banner_middle_height" alt="{{ $banner_bottom->title }}"></a>
					@endempty
				</div>
				@endif
			</div>
		</div>
	</div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/jssocials/jssocials.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection