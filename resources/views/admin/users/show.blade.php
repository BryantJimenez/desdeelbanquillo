@extends('layouts.admin')

@section('title', 'Perfil de Usuario')

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

	<div class="user-profile layout-spacing">
		<div class="widget-content widget-content-area">
			<div class="d-flex justify-content-between">
				<h3 class="pb-3">Datos Personales</h3>
			</div>
			<div class="text-center user-info">
				<img src="{{ asset('/admins/img/users/'.$user->photo) }}" width="90" height="90" alt="Foto de perfil">
				<p class="">{{ $user->name." ".$user->lastname }}</p>
			</div>
			<div class="user-info-list">

				<div class="">
					<ul class="contacts-block list-unstyled">
						<li class="contacts-block__item">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>{!! typeUser($user->type) !!}
						</li>
						<li class="contacts-block__item">
							<a href="mailto:{{ $user->email }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>{{ $user->email }}</a>
						</li>
					</ul>
				</div>                                    
			</div>
		</div>
	</div>
</div>

@endsection