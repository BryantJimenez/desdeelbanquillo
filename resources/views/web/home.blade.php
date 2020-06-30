@extends('layouts.web')

@section('title', 'Inicio')

@section('links')
<!-- Lightgallery -->
<link rel="stylesheet" href="{{ asset('/admins/vendor/lightgallery/lightgallery.css') }}">
@endsection

@section('content')

<section class="ftco-section py-0">
    <div class="container bg-white pt-1">
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('/web/img/bannerprincipal.png') }}" class="d-block w-100 banner-image" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('/web/img/bannerprincipal.png') }}" class="d-block w-100 banner-image" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('/web/img/bannerprincipal.png') }}" class="d-block w-100 banner-image" alt="Slide 3">
                </div>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section py-0">
    <div class="container bg-white py-1">
        <div class="row">

            <div class="col-lg-6 col-12 py-1">
                <a href="#" class="card bg-dark text-white border-0 rounded-0 overflow-hidden">
                    <img src="{{ asset('/web/img/noticia1de5.png') }}" class="card-img zoom" alt="Noticia">
                    <div class="card-img-overlay abosulute-top-unset overlay-dark px-3 py-1">
                        <h4 class="card-text title-principal-notice text-white font-weight-bold mb-0">Real Sociedad se hizo respetar en la última etapa y cambio el fixture en un interesante partido</h4>
                        <p class="card-text text-right font-jost">1 día <i class="fa fa-clock-o ml-2"></i></p>
                    </div>
                </a>
            </div>

            <div class="col-lg-6 col-12">
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-12 py-1 pr-md-1 pr-lg-1 pr-xl-1">
                        <a href="#" class="card bg-dark text-white border-0 rounded-0 overflow-hidden">
                            <img src="{{ asset('/web/img/noticia2de5.png') }}" class="card-img zoom" alt="Noticia">
                            <div class="card-img-overlay abosulute-top-unset overlay-dark px-2 pt-2 pb-1">
                                <p class="card-text title-secondary-notice ln-sm mb-0">El Nápoles, festeja y va directo a la Final de la Copa</p>
                                <p class="card-text text-right font-jost">1 día <i class="fa fa-clock-o ml-2"></i></p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 py-1 pl-md-1 pl-lg-1 pl-xl-1">
                        <a href="#" class="card bg-dark text-white border-0 rounded-0 overflow-hidden">
                            <img src="{{ asset('/web/img/noticia3de5.png') }}" class="card-img zoom" alt="Noticia">
                            <div class="card-img-overlay abosulute-top-unset overlay-dark px-2 pt-2 pb-1">
                                <p class="card-text title-secondary-notice ln-sm mb-0">El Universitario FC anuncia el compromiso del entrenador Carlos Marín Lópezes</p>
                                <p class="card-text text-right font-jost">3 días <i class="fa fa-clock-o ml-2"></i></p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 py-1 pr-md-1 pr-lg-1 pr-xl-1">
                        <a href="#" class="card bg-dark text-white border-0 rounded-0 overflow-hidden">
                            <img src="{{ asset('/web/img/noticia4de5.png') }}" class="card-img zoom" alt="Noticia">
                            <div class="card-img-overlay abosulute-top-unset overlay-dark px-2 pt-2 pb-1">
                                <p class="card-text title-secondary-notice ln-sm mb-0">Un gol que lo cambio todo...</p>
                                <p class="card-text text-right font-jost">2 días <i class="fa fa-clock-o ml-2"></i></p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 py-1 pl-md-1 pl-lg-1 pl-xl-1">
                        <a href="#" class="card bg-dark text-white border-0 rounded-0 overflow-hidden">
                            <img src="{{ asset('/web/img/noticia5de5.png') }}" class="card-img zoom" alt="Noticia">
                            <div class="card-img-overlay abosulute-top-unset overlay-dark px-2 pt-2 pb-1">
                                <p class="card-text title-secondary-notice ln-sm mb-0">Una nueva Generación de Campeones</p>
                                <p class="card-text text-right font-jost">3 días <i class="fa fa-clock-o ml-2"></i></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="ftco-section py-0">
    <div class="container bg-white py-2">
        <div class="row">
            <div class="col-12">
                <img src="{{ asset('/web/img/bannerprincipallargo.png') }}" class="w-100" alt="Publicidad">
            </div>
        </div>
    </div>
</section>

<section class="ftco-section py-0">
    <div class="container bg-white py-1">
        <div class="row h-330-px h-400-px">
            <div class="col-lg-3 col-md-6 col-12 order-lg-0 order-md-0 order-0 py-1 h-max-content">
                <div class="row">
                    <div class="col-12 heading-section text-left d-flex justify-content-between pb-1">
                        <p class="h6 text-dark font-weight-bold text-uppercase border-left-red m-0"> Últimos Resultados </p>
                        <span class="controls-last-results d-flex justify-content-between">
                            <a class="carousel-control-prev" href="#carousel-2" role="button" data-slide="prev">
                                <span class="fa fa-angle-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-2" role="button" data-slide="next">
                                <span class="fa fa-angle-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </span>
                    </div>

                    <div class="col-12">
                        <hr class="mb-3 mt-1">
                        <div id="carousel-2" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="card rounded-bottom rounded-top-0 border-orange mb-2">
                                        <div class="card-body py-xxl-4 py-2">
                                            <div class="row">
                                                <div class="col-4 pl-lg-1 pr-lg-0 d-flex justify-content-center flex-column">
                                                    <img src="{{ asset('/web/img/escudo1.png') }}" class="border mx-auto p-2" width="60" height="60">
                                                    <p class="text-center text-dark font-weight-bold small mb-0">Barcelona</p>
                                                </div>
                                                <div class="col-4 px-0">
                                                    <p class="h2 font-weight-bold d-flex justify-content-between pt-2">
                                                        <span>1</span>
                                                        <span>-</span>
                                                        <span>0</span>
                                                    </p>
                                                </div>
                                                <div class="col-4 pl-lg-1 pr-lg-0 d-flex justify-content-center flex-column">
                                                    <img src="{{ asset('/web/img/escudo2.png') }}" class="border mx-auto p-2" width="60" height="60">
                                                    <p class="text-center text-dark font-weight-bold small mb-0">Mallorca</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-white p-1">
                                            <p class="text-center text-muted font-weight-bold small font-size-10 mb-0">Estadio: Bella Italia / 14 de Junio, 2020</p>
                                        </div>
                                    </div>

                                    <div class="card rounded-bottom rounded-top-0 border-orange mb-2">
                                        <div class="card-body py-xxl-4 py-2">
                                            <div class="row">
                                                <div class="col-4 pl-lg-1 pr-lg-0 d-flex justify-content-center flex-column">
                                                    <img src="{{ asset('/web/img/escudo1.png') }}" class="border mx-auto p-2" width="60" height="60">
                                                    <p class="text-center text-dark font-weight-bold small mb-0">Barcelona</p>
                                                </div>
                                                <div class="col-4 px-0">
                                                    <p class="h2 font-weight-bold d-flex justify-content-between pt-2">
                                                        <span>1</span>
                                                        <span>-</span>
                                                        <span>0</span>
                                                    </p>
                                                </div>
                                                <div class="col-4 pl-lg-1 pr-lg-0 d-flex justify-content-center flex-column">
                                                    <img src="{{ asset('/web/img/escudo2.png') }}" class="border mx-auto p-2" width="60" height="60">
                                                    <p class="text-center text-dark font-weight-bold small font-size-10 mb-0">Mallorca</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-white p-1">
                                            <p class="text-center text-muted font-weight-bold small font-size-10 mb-0">Estadio: Bella Italia / 14 de Junio, 2020</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="card rounded-bottom rounded-top-0 border-orange mb-2">
                                        <div class="card-body py-xxl-4 py-2">
                                            <div class="row">
                                                <div class="col-4 pl-lg-1 pr-lg-0 d-flex justify-content-center flex-column">
                                                    <img src="{{ asset('/web/img/escudo1.png') }}" class="border mx-auto p-2" width="60" height="60">
                                                    <p class="text-center text-dark font-weight-bold small mb-0">Barcelona</p>
                                                </div>
                                                <div class="col-4 px-0">
                                                    <p class="h2 font-weight-bold d-flex justify-content-between pt-2">
                                                        <span>1</span>
                                                        <span>-</span>
                                                        <span>0</span>
                                                    </p>
                                                </div>
                                                <div class="col-4 pl-lg-1 pr-lg-0 d-flex justify-content-center flex-column">
                                                    <img src="{{ asset('/web/img/escudo2.png') }}" class="border mx-auto p-2" width="60" height="60">
                                                    <p class="text-center text-dark font-weight-bold small mb-0">Mallorca</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-white p-1">
                                            <p class="text-center text-muted font-weight-bold small font-size-10 mb-0">Estadio: Bella Italia / 14 de Junio, 2020</p>
                                        </div>
                                    </div>

                                    <div class="card rounded-bottom rounded-top-0 border-orange mb-2">
                                        <div class="card-body py-xxl-4 py-2">
                                            <div class="row">
                                                <div class="col-4 pl-lg-1 pr-lg-0 d-flex justify-content-center flex-column">
                                                    <img src="{{ asset('/web/img/escudo1.png') }}" class="border mx-auto p-2" width="60" height="60">
                                                    <p class="text-center text-dark font-weight-bold small mb-0">Barcelona</p>
                                                </div>
                                                <div class="col-4 px-0">
                                                    <p class="h2 font-weight-bold d-flex justify-content-between pt-2">
                                                        <span>1</span>
                                                        <span>-</span>
                                                        <span>0</span>
                                                    </p>
                                                </div>
                                                <div class="col-4 pl-lg-1 pr-lg-0 d-flex justify-content-center flex-column">
                                                    <img src="{{ asset('/web/img/escudo2.png') }}" class="border mx-auto p-2" width="60" height="60">
                                                    <p class="text-center text-dark font-weight-bold small font-size-10 mb-0">Mallorca</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-white p-1">
                                            <p class="text-center text-muted font-weight-bold small font-size-10 mb-0">Estadio: Bella Italia / 14 de Junio, 2020</p>
                                        </div>
                                    </div>
                                </div>
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

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 pt-1">
                        <div class="card card-horizontal border-bottom-0 border-left-0 border-right-0 border-primary rounded-0 pt-2">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-7 col-8">
                                    <div class="card-body px-0 py-1">
                                        <a href="#"><h5 class="card-title ln-sm mb-1">Ronaldo y Messi vuelven a las canchas en los tiempos del COVID-19</h5></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5 col-4 overflow-hidden">
                                    <a href="#"><img src="{{ asset('/web/img/noticiadestacada1de4.png') }}" class="w-100 square-image zoom" alt="Noticia"></a>
                                </div>
                            </div>
                            <p class="card-text d-flex justify-content-between mt-2">
                                <small class="text-dark">1 día <i class="fa fa-clock-o"></i></small>
                                <small class="text-dark">4 Comentarios <i class="fa fa-comment-o"></i></small>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 pt-1">
                        <div class="card card-horizontal border-bottom-0 border-left-0 border-right-0 border-primary rounded-0 pt-2">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-7 col-8">
                                    <div class="card-body px-0 py-1">
                                        <a href="#"><h5 class="card-title ln-sm mb-1">Nuevamente el talento femenino se apodero del Clásico</h5></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5 col-4 overflow-hidden">
                                    <a href="#"><img src="{{ asset('/web/img/noticiadestacada2de4.png') }}" class="w-100 square-image zoom" alt="Noticia"></a>
                                </div>
                            </div>
                            <p class="card-text d-flex justify-content-between mt-2">
                                <small class="text-dark">1 día <i class="fa fa-clock-o"></i></small>
                                <small class="text-dark">4 Comentarios <i class="fa fa-comment-o"></i></small>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 pt-1">
                        <div class="card card-horizontal border-left-0 border-right-0 border-bottom-sm-0 border-primary rounded-0 pt-2">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-7 col-8">
                                    <div class="card-body px-0 py-1">
                                        <a href="#"><h5 class="card-title ln-sm mb-1">Mallorca derrota 1 a 0 a Barcelona</h5></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5 col-4 overflow-hidden">
                                    <a href="#"><img src="{{ asset('/web/img/noticiadestacada3de4.png') }}" class="w-100 square-image zoom" alt="Noticia"></a>
                                </div>
                            </div>
                            <p class="card-text d-flex justify-content-between mt-2">
                                <small class="text-dark">1 día <i class="fa fa-clock-o"></i></small>
                                <small class="text-dark">4 Comentarios <i class="fa fa-comment-o"></i></small>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 pt-1">
                        <div class="card card-horizontal border-left-0 border-right-0 border-primary rounded-0 pt-2">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-7 col-8">
                                    <div class="card-body px-0 py-1">
                                        <a href="#"><h5 class="card-title ln-sm mb-1">Siete curiosidades del estadio Alfredo Di Stéfano</h5></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5 col-4 overflow-hidden">
                                    <a href="#"><img src="{{ asset('/web/img/noticiadestacada4de4.png') }}" class="w-100 square-image zoom" alt="Noticia"></a>
                                </div>
                            </div>
                            <p class="card-text d-flex justify-content-between mt-2">
                                <small class="text-dark">1 día <i class="fa fa-clock-o"></i></small>
                                <small class="text-dark">4 Comentarios <i class="fa fa-comment-o"></i></small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 order-lg-2 order-md-1 order-2 pt-2 h-max-content">
                <img src="{{ asset('/web/img/bannermacdonalds.png') }}" class="w-100 h-md-330-px h-max-content pt-4" alt="Publicidad">
            </div>
        </div>
    </div>
</section>

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
            <div class="col-lg-6 col-12">
                <iframe class="w-100" height="320" src="https://www.youtube.com/embed/Y-NeVAOkMlI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-lg-6 col-12">
                <iframe class="w-100" height="320" src="https://www.youtube.com/embed/FCcrB1ZXYQM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section py-0">
    <div class="container bg-white py-1">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="row px-3 pb-3">
                    <div class="col-12 pt-2 px-2 bg-light-grey">
                        <div class="card card-horizontal rounded-0 mb-3">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-4 col-12 overflow-hidden">
                                    <a href="#"><img src="{{ asset('/web/img/noticia1de5.png') }}" class="h-100 w-100 zoom" alt="Noticia"></a>
                                </div>
                                <div class="col-lg-6 col-md-8 col-12">
                                    <div class="card-body">
                                        <a href="#"><h5 class="card-title font-weight-bold text-uppercase mb-1">Zidane: "We're not going to change the way we play at the calderón"</h5></a>
                                        <p class="card-text border-bottom pb-3"><small class="text-muted font-weight-bold text-uppercase"><span class="badge badge-danger mr-2">Hot <i class="fa fa-fire"></i></span> <i class="fa fa-clock-o"></i> April 15, 2020</small></p>
                                        <p class="card-text text-description">Zidane spoke to the media at the Real Madrid City. The Whites coach explained how the team is going in to the second leg of the Champions...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-2 bg-light-grey">
                        <div class="card card-horizontal rounded-0 mb-2">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-4 col-12 overflow-hidden">
                                    <a href="#"><img src="{{ asset('/web/img/noticia1de5.png') }}" class="h-100 w-100 zoom" alt="Noticia"></a>
                                </div>
                                <div class="col-lg-6 col-md-8 col-12">
                                    <div class="card-body">
                                        <a href="#"><h5 class="card-title font-weight-bold text-uppercase mb-1">NFL will handle referee Pete Morelli's use of profanity internally</h5></a>
                                        <p class="card-text border-bottom pb-3"><small class="text-muted font-weight-bold text-uppercase"><span class="badge badge-success mr-2">The League</span> <i class="fa fa-clock-o"></i> April 15, 2020</small></p>
                                        <p class="card-text text-description">The NFL will internally address referee Pete Morelli's recent microphone gaffe, a league spokesman said, but it does not appear Morelli...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="row">
                    <div class="col-12 heading-section text-left pb-2">
                        <p class="h6 text-dark font-weight-bold text-uppercase border-left-red m-0 mb-3"> Galeria de Fotos</p>

                        <div class="row">
                            <div class="col-12 d-flex flex-wrap justify-content-between" id="lightgallery">
                                <a href="{{ asset('/web/img/fotogaleria1.png') }}" class="gallery-image overflow-hidden position-relative mb-3">
                                    <img src="{{ asset('/web/img/fotogaleria1.png') }}" class="w-100" alt="Noticia">
                                    <div class="overlay-dark-gallery text-white d-flex justify-content-center"><i class="fa fa-search"></i></div>
                                </a>
                                <a href="{{ asset('/web/img/fotogaleria1.png') }}" class="gallery-image overflow-hidden position-relative mb-3">
                                    <img src="{{ asset('/web/img/fotogaleria1.png') }}" class="w-100" alt="Noticia">
                                    <div class="overlay-dark-gallery text-white d-flex justify-content-center"><i class="fa fa-search"></i></div>
                                </a>
                                <a href="{{ asset('/web/img/fotogaleria1.png') }}" class="gallery-image overflow-hidden position-relative mb-3">
                                    <img src="{{ asset('/web/img/fotogaleria1.png') }}" class="w-100" alt="Noticia">
                                    <div class="overlay-dark-gallery text-white d-flex justify-content-center"><i class="fa fa-search"></i></div>
                                </a>
                                <a href="{{ asset('/web/img/fotogaleria1.png') }}" class="gallery-image overflow-hidden position-relative mb-3">
                                    <img src="{{ asset('/web/img/fotogaleria1.png') }}" class="w-100" alt="Noticia">
                                    <div class="overlay-dark-gallery text-white d-flex justify-content-center"><i class="fa fa-search"></i></div>
                                </a>
                                <a href="{{ asset('/web/img/fotogaleria1.png') }}" class="gallery-image overflow-hidden position-relative mb-3">
                                    <img src="{{ asset('/web/img/fotogaleria1.png') }}" class="w-100" alt="Noticia">
                                    <div class="overlay-dark-gallery text-white d-flex justify-content-center"><i class="fa fa-search"></i></div>
                                </a>
                                <a href="{{ asset('/web/img/fotogaleria1.png') }}" class="gallery-image overflow-hidden position-relative mb-3">
                                    <img src="{{ asset('/web/img/fotogaleria1.png') }}" class="w-100" alt="Noticia">
                                    <div class="overlay-dark-gallery text-white d-flex justify-content-center"><i class="fa fa-search"></i></div>
                                </a>
                                <a href="{{ asset('/web/img/fotogaleria1.png') }}" class="gallery-image overflow-hidden position-relative mb-3">
                                    <img src="{{ asset('/web/img/fotogaleria1.png') }}" class="w-100" alt="Noticia">
                                    <div class="overlay-dark-gallery text-white d-flex justify-content-center"><i class="fa fa-search"></i></div>
                                </a>
                                <a href="{{ asset('/web/img/fotogaleria1.png') }}" class="gallery-image overflow-hidden position-relative mb-3">
                                    <img src="{{ asset('/web/img/fotogaleria1.png') }}" class="w-100" alt="Noticia">
                                    <div class="overlay-dark-gallery text-white d-flex justify-content-center"><i class="fa fa-search"></i></div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 pb-2">
                        <img src="{{ asset('/web/img/bannerreebook.png') }}" class="d-block w-100" alt="Publicidad">
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