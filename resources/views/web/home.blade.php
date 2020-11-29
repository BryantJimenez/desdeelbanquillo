@extends('layouts.web')

@section('title', 'Desde el Banquillo')

@section('links')
<!-- Lightgallery -->
<link rel="stylesheet" href="{{ asset('/admins/vendor/lightgallery/lightgallery.css') }}">
@endsection

@section('content')

@if(count($carousels)>0)
<section class="ftco-section py-0">
    <div class="container bg-white pt-1">
        <div id="carousel" class="carousel slide" data-ride="carousel">
            @if(count($carousels)>1)
            <ol class="carousel-indicators">
                @foreach($carousels as $carousel)
                <li data-target="#carousel" data-slide-to="{{ $num++ }}" @if($loop->first) class="active" @endif></li>
                @endforeach
            </ol>
            @endif
            <div class="carousel-inner">
                @foreach($carousels as $carousel)
                <div class="carousel-item @if($loop->first) active @endif">
                    @empty($carousel->url)
                    <img src="{{ asset('/admins/img/banners/'.$carousel->image) }}" class="d-block w-100 banner-image" alt="{{ $carousel->title }}">
                    @else
                    <a href="{{ $carousel->pre_url.$carousel->url }}" @if($carousel->target==2) target="_blank" @endif><img src="{{ asset('/admins/img/banners/'.$carousel->image) }}" class="d-block w-100 banner-image" alt="{{ $carousel->title }}"></a>
                    @endempty
                </div>
                @endforeach

                @if(count($carousels)>1)
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

@if(count($super_featured)>0)
<section class="ftco-section py-0">
    <div class="container bg-white py-1">
        <div class="row">

            <div class="col-lg-6 col-12 py-1">
                <a href="{{ route('new', ['category' => $super_featured[0]->categories[0]->slug, 'slug' => $super_featured[0]->slug]) }}" class="card bg-dark text-white border-0 rounded-0 overflow-hidden">
                    <img src="{{ asset('/admins/img/news/'.$super_featured[0]->image) }}" class="card-img super-featured-first zoom" alt="{{ $super_featured[0]->title }}">
                    <div class="card-img-overlay abosulute-top-unset overlay-dark px-3 py-1">
                        <h4 class="card-text title-principal-notice text-white font-weight-bold">{{ $super_featured[0]->title }}</h4>
                    </div>
                </a>
            </div>

            <div class="col-lg-6 col-12">
                <div class="row">
                    @foreach($super_featured as $featured)
                    @if($loop->index!=0)
                    <div class="col-lg-6 col-md-6 col-12 py-1">
                        <a href="{{ route('new', ['category' => $featured->categories[0]->slug, 'slug' => $featured->slug]) }}" class="card bg-dark text-white border-0 rounded-0 overflow-hidden">
                            <img src="{{ asset('/admins/img/news/'.$featured->image) }}" class="card-img super-featured zoom" alt="{{ $featured->title }}">
                            <div class="card-img-overlay abosulute-top-unset overlay-dark px-2 pt-2 pb-1">
                                <p class="card-text title-secondary-notice ln-sm">{{ $featured->title }}</p>
                            </div>
                        </a>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
@endif

@if(!empty($banner_width))
<section class="ftco-section py-0">
    <div class="container bg-white py-2">
        <div class="row">
            <div class="col-12">
                @empty($banner_width->url)
                <img src="{{ asset('/admins/img/banners/'.$banner_width->image) }}" class="w-100 banner_width_height" alt="{{ $banner_width->title }}">
                @else
                <a href="{{ $banner_width->pre_url.$banner_width->url }}" @if($banner_width->target==2) target="_blank" @endif><img src="{{ asset('/admins/img/banners/'.$banner_width->image) }}" class="w-100 banner_width_height" alt="{{ $banner_width->title }}"></a>
                @endempty
            </div>
        </div>
    </div>
</section>
@endif

<section class="ftco-section py-0">
    <div class="container bg-white py-1">
        <div class="row h-330-px h-400-px">
            <div class="col-lg-3 col-md-6 col-12 order-lg-0 order-md-0 order-0 py-1 h-max-content">
                <div class="row">
                    <div class="col-12 heading-section text-left d-flex justify-content-between pb-1">
                        <p class="h6 text-dark font-weight-bold text-uppercase border-left-red m-0"> Últimos Resultados </p>
                        <span class="controls-last-results d-flex justify-content-between">
                            @if(count($matches)>1)
                            <a class="carousel-control-prev" href="#carousel-2" role="button" data-slide="prev">
                                <span class="fa fa-angle-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-2" role="button" data-slide="next">
                                <span class="fa fa-angle-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            @endif
                        </span>
                    </div>

                    <div class="col-12">
                        <hr class="mb-3 mt-1">
                        <div id="carousel-2" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($matches as $match)
                                <div class="carousel-item @if($loop->index==0) active @endif">
                                    @foreach($match as $result)
                                    <div class="card rounded-bottom rounded-top-0 border-orange mb-2">
                                        <div class="card-body py-xxl-4 py-1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="text-center text-muted font-weight-bold small font-size-10 mb-0">{{ $result->day->tournament->title }}</p>
                                                </div>
                                                <div class="col-4 pl-lg-1 pr-lg-0 d-flex justify-content-center flex-column">
                                                    <img src="{{ asset('/admins/img/teams/'.$result->teams[0]->shield) }}" class="border mx-auto p-1" width="60" height="60" alt="{{ $result->teams[0]->name }}">
                                                    <p class="text-center text-dark font-weight-bold small mb-0">{{ $result->teams[0]->name }}</p>
                                                </div>
                                                <div class="col-4 px-0">
                                                    <p class="h2 font-weight-bold d-flex justify-content-between pt-2">
                                                        <span>@if(!is_null($result->teams[0]->pivot->goals)){{ $result->teams[0]->pivot->goals }}@else{{ "-" }}@endif</span>
                                                        <span>-</span>
                                                        <span>@if(!is_null($result->teams[1]->pivot->goals)){{ $result->teams[1]->pivot->goals }}@else{{ "-" }}@endif</span>
                                                    </p>
                                                </div>
                                                <div class="col-4 pl-lg-1 pr-lg-0 d-flex justify-content-center flex-column">
                                                    <img src="{{ asset('/admins/img/teams/'.$result->teams[1]->shield) }}" class="border mx-auto p-1" width="60" height="60" alt="{{ $result->teams[1]->name }}">
                                                    <p class="text-center text-dark font-weight-bold small mb-0">{{ $result->teams[1]->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-white p-0">
                                            <p class="text-center text-muted font-weight-bold small font-size-10 mb-0">Estadio: {{ $result->stadium->name }} / {{ date('d-m-Y', strtotime($result->date)) }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-12 order-lg-1 order-md-2 order-1 py-1 h-max-content">
                <div class="row">
                    <div class="col-12 heading-section text-left pb-2">
                        <p class="h6 text-dark font-weight-bold text-uppercase border-left-blue m-0"> Noticias Destacadas</p>
                    </div>

                    @foreach($featureds as $featured)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 pt-1">
                        <div class="card card-horizontal @if($loop->index==0) border-bottom-0 border-left-0 border-right-0 @elseif($loop->index==1) border-bottom-0 border-left-0 border-right-0 border-primary @elseif($loop->index==2) border-left-0 border-right-0 border-bottom-sm-0 border-primary @elseif($loop->index==3) border-left-0 border-right-0 border-primary @endif border-primary rounded-0 pt-2">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-7 col-8">
                                    <div class="card-body px-0 py-1">
                                        <a href="{{ route('new', ['category' => $featured->categories[0]->slug, 'slug' => $featured->slug]) }}"><h5 class="card-title ln-sm mb-1">{{ $featured->title }}</h5></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5 col-4 overflow-hidden">
                                    <a href="{{ route('new', ['category' => $featured->categories[0]->slug, 'slug' => $featured->slug]) }}"><img src="{{ asset('/admins/img/news/'.$featured->image) }}" class="w-100 square-image zoom" alt="{{ $featured->title }}"></a>
                                </div>
                            </div>
                            <p class="card-text d-flex justify-content-end mt-2">
                                <small class="text-dark">{{ count($featured->comments) }} Comentarios <i class="fa fa-comment-o"></i></small>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 order-lg-2 order-md-1 order-2 pt-2 h-max-content">
                @if(!empty($banner_middle))
                @empty($banner_middle->url)
                <img src="{{ asset('/admins/img/banners/'.$banner_middle->image) }}" class="w-100 h-md-330-px h-max-content banner_middle_height mt-4" alt="{{ $banner_middle->title }}">
                @else
                <a href="{{ $banner_middle->pre_url.$banner_middle->url }}" @if($banner_middle->target==2) target="_blank" @endif><img src="{{ asset('/admins/img/banners/'.$banner_middle->image) }}" class="w-100 h-md-330-px h-max-content banner_middle_height mt-4" alt="{{ $banner_middle->title }}"></a>
                @endempty
                @endif
            </div>
        </div>
    </div>
</section>

@if(count($videos)>0)
<section class="ftco-section py-0">
    <div class="container bg-white pt-3">
        <div class="row justify-content-center pb-3">
            <div class="col-md-12 heading-section text-center">
                <p class="h5 font-weight-bold m-0"><img src="{{ asset('/web/img/youtube.svg') }}" alt="videos" width="50"> ÚLTIMOS VIDEOS</p>
            </div>
        </div>
    </div>
    <div class="container bg-white pb-1">
        <div class="row">
            @foreach($videos as $video)
            <div class="col-lg-6 col-12">
                <iframe class="w-100" height="320" src="{{ youtubeUrl($video->video) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="ftco-section py-0">
    <div class="container bg-white py-1">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="row px-3 pb-3">
                    @foreach($bottom_featured as $featured)
                    <div class="col-12 pt-2 px-2 bg-light-grey">
                        <div class="card card-horizontal rounded-0 mb-2">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-4 col-12 overflow-hidden">
                                    <a href="{{ route('new', ['category' => $featured->categories[0]->slug, 'slug' => $featured->slug]) }}"><img src="{{ asset('/admins/img/news/'.$featured->image) }}" class="h-100 w-100 zoom" alt="{{ $featured->title }}"></a>
                                </div>
                                <div class="col-lg-6 col-md-8 col-12">
                                    <div class="card-body">
                                        <a href="{{ route('new', ['category' => $featured->categories[0]->slug, 'slug' => $featured->slug]) }}"><h5 class="card-title font-weight-bold text-uppercase mb-1">{{ $featured->title }}</h5></a>
                                        <p class="card-text border-bottom pb-3"><small class="text-muted font-weight-bold text-uppercase"><span class="badge badge-success mr-2">{{ $featured->categories[0]->name }}</span> <i class="fa fa-clock-o"></i> {{ $featured->created_at->toFormattedDateString() }}</small></p>
                                        <p class="card-text text-description">@if(strlen($featured->summary)>135){{ substr($featured->summary, 0, 135)."..." }}@else{{ $featured->summary }}@endif</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="row">
                    <div class="col-12 heading-section text-left pb-2">
                        <p class="h6 text-dark font-weight-bold text-uppercase border-left-red m-0 mb-3"> Galeria de Fotos</p>

                        <div class="row">
                            <div class="col-12 d-flex flex-wrap justify-content-between" id="lightgallery">
                                @foreach($galleries as $gallery)
                                <a href="{{ asset('/admins/img/galleries/'.$gallery->image) }}" class="gallery-image overflow-hidden position-relative mb-3">
                                    <img src="{{ asset('/admins/img/galleries/'.$gallery->image) }}" class="w-100" alt="{{ $gallery->title }}">
                                    <div class="overlay-dark-gallery text-white d-flex justify-content-center"><i class="fa fa-search"></i></div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @if(!empty($banner_bottom))
                    <div class="col-12 pb-2">
                        @empty($banner_bottom->url)
                        <img src="{{ asset('/admins/img/banners/'.$banner_bottom->image) }}" class="d-block w-100 banner_bottom_height" alt="{{ $banner_bottom->title }}">
                        @else
                        <a href="{{ $banner_bottom->pre_url.$banner_bottom->url }}" @if($banner_bottom->target==2) target="_blank" @endif><img src="{{ asset('/admins/img/banners/'.$banner_bottom->image) }}" class="d-block w-100 banner_bottom_height" alt="{{ $banner_bottom->title }}"></a>
                        @endempty
                    </div>
                    @endif
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