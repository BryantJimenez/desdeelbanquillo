@extends('layouts.web')

@section('title', 'Videos')

@section('content')

<section class="ftco-section py-0">
	<div class="container bg-white pb-1 pt-2">
		<div class="row">
			<div class="col-12">
				<p><a href="{{ route('home') }}" class="text-danger">Home</a> <i class="fa fa-angle-right"></i> Videos</p>
			</div>

			<div class="col-12">
				<div class="card shadow mb-2">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<p class="h5 text-center text-red"><img src="{{ asset('/web/img/videos.png') }}" class="mr-2" alt="videos" width="55"> Galeria de Videos</p>
							</div>

							@foreach($videos as $video)
							<div class="col-lg-6 col-12">
								<div class="card border-red rounded-0 mt-3 mb-2">
									<div class="card-body p-0">
										<iframe class="w-100" height="320" src="{{ youtubeUrl($video->video) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
										<div class="d-flex justify-content-between px-2 pb-1">
											<a href="javascript:void(0);"><p class="card-text text-muted">{{ $video->title }}</p></a>
											<p class="text-muted mb-0"><i class="fa fa-calendar pr-1"></i>{{ $video->created_at->format('d/m/Y') }}</p>
										</div>
									</div>
								</div>
							</div>
							@endforeach

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