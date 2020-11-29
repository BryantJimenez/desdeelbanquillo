@extends('layouts.web')

@section('title', 'Noticias')

@section('content')

<section class="ftco-section py-0">
	<div class="container bg-white pb-1 pt-2">
		<div class="row">
			<div class="col-12">
				<p><a href="{{ route('home') }}" class="text-danger">Home</a> <i class="fa fa-angle-right"></i> Todas las Noticias</p>
			</div>

			<div class="col-12">
				<div class="card shadow mb-2">
					<div class="card-body">
						<div class="row">
							<div class="col-12 mb-4">
								<p class="h5 text-red">
									<span class="pr-3 py-3"><img src="{{ asset('/web/img/categorias.png') }}" class="mr-2" alt="categorias" width="35">Categorías:</span> 
									<a href="{{ route('news') }}" class="btn @if(is_null($selected)) btn-outline-primary @else btn-primary @endif mr-3 mt-2">Todas</a>
									@foreach($categories as $category)
									@if(count($category->news)>0)
									<a href="{{ route('news', ['category' => $category->slug]) }}" class="btn @if(!is_null($selected) && $selected==$category->slug) btn-outline-primary @else btn-primary @endif mr-3 mt-2">{{ $category->name }}</a>
									@endif
									@endforeach
								</p>
							</div>

							@forelse($news as $new)
							<div class="col-lg-4 col-md-6 col-12">
								<div class="card border-0 mt-3 mb-2">
									@if(is_null($search))
									<a href="{{ route('new', ['category' => $new->categories[0]->slug, 'slug' => $new->slug]) }}" class="overflow-hidden"><img src="{{ asset('/admins/img/news/'.$new->image) }}" class="card-img-top image-news rounded zoom" alt="{{ $new->title }}"></a>
									@else
									<a href="{{ route('new', ['category' => $search['slug'], 'slug' => $new->slug]) }}" class="overflow-hidden"><img src="{{ asset('/admins/img/news/'.$new->image) }}" class="card-img-top image-news rounded zoom" alt="{{ $new->title }}"></a>
									@endif
									<div class="card-body px-0 pt-2">
										@if(is_null($search))
										<a href="{{ route('new', ['category' => $new->categories[0]->slug, 'slug' => $new->slug]) }}"><h5 class="card-title font-weight-bold">{{ $new->title }}</h5></a>
										@else
										<a href="{{ route('new', ['category' => $search['slug'], 'slug' => $new->slug]) }}"><h5 class="card-title font-weight-bold">{{ $new->title }}</h5></a>
										@endif
										<div class="d-flex justify-content-between mb-2">
											<a class="btn btn-primary text-white py-1">@if(is_null($search)){{ $new->categories[0]->name }}@else{{ $search['name'] }}@endif</a>
											<p class="text-muted mb-0"><i class="fa fa-calendar-o text-red pr-1"></i>{{ $new->created_at->format('d/m/Y') }} <i class="fa fa-comments-o text-red pl-2 pr-1"></i>{{ count($new->comments) }} Comentarios</p>
										</div>
										<p class="card-text">@if(strlen($new->summary)>135){{ substr($new->summary, 0, 135)."..." }}@else{{ $new->summary }}@endif</p>
									</div>
								</div>
							</div>
							@empty
							<div class="col-12">
								<p class="h3 text-center text-danger">No hay ninguna noticia</p>
							</div>
							@endforelse

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