@extends('layouts.web')

@section('title', "Resultados de Busqueda")

@section('content')

<section class="ftco-section py-0">
	<div class="container bg-white pb-1 pt-2">
		<div class="row">
			<div class="col-12">
				<p><a href="{{ route('home') }}" class="text-danger">Home</a> <i class="fa fa-angle-right"></i> Resultados de Busqueda</p>
			</div>

			<div class="col-12">
				<div class="card shadow mb-2">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<p class="h5 text-center"><img src="{{ asset('/web/img/lupa.png') }}" class="mr-2" alt="Buscar" width="35"><span class="text-red">{{ count($news) }}</span> Resultados de Busqueda</p>
							</div>

							@forelse($news as $new)
							@if($loop->index>=$offset && $loop->index<$offset+9)
							<div class="col-lg-4 col-md-6 col-12">
								<div class="card border-0 mt-3 mb-2">
									<a href="{{ route('new', ['category' => $new->categories[0]->slug, 'slug' => $new->slug]) }}" class="overflow-hidden"><img src="{{ asset('/admins/img/news/'.$new->image) }}" class="card-img-top image-news rounded zoom" alt="{{ $new->title }}"></a>
									<div class="card-body px-0 pt-2">
										<a href="{{ route('new', ['category' => $new->categories[0]->slug, 'slug' => $new->slug]) }}"><h5 class="card-title font-weight-bold">{{ $new->title }}</h5></a>
										<div class="d-flex justify-content-between mb-2">
											<a class="btn btn-primary text-white py-1">{{ $new->categories[0]->name }}</a>
											<p class="text-muted mb-0"><i class="fa fa-calendar-o text-red pr-1"></i>{{ $new->created_at->format('d/m/Y') }} <i class="fa fa-comments-o text-red pl-2 pr-1"></i>{{ count($new->comments) }} Comentarios</p>
										</div>
										<p class="card-text">@if(strlen($new->summary)>135){{ substr($new->summary, 0, 135)."..." }}@else{{ $new->summary }}@endif</p>
									</div>
								</div>
							</div>
							@endif
							@empty
							<div class="col-12">
								<p class="h1 text-center text-danger py-5 my-5">No se ha encontrado ninguna noticia</p>
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