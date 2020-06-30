<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>

	{{-- <link rel="icon" href="{{ asset('/auth/images/icons/favicon.ico') }}" type="image/x-icon" /> --}}

	<meta name="description" content="">
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />

	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('/web/css/font-awesome.min.css') }}">
	<!-- Bootstrap core CSS -->
	<link href="{{ asset('/web/css/bootstrap.css') }}" rel="stylesheet">
	
	@yield('links')

	<!-- Style CSS -->
	<link href="{{ asset('/web/css/style.css') }}" rel="stylesheet">
	<!-- Style CSS -->
</head>
<body class="goto-here bg-light-grey">

	@include('web.partials.navbar')

	@yield('content')

	@include('web.partials.footer')
	
	@include('web.partials.loader')

	@guest
	@include('web.partials.login')
	@include('web.partials.register')
	@endguest

	<!-- JQuery -->
	<script type="text/javascript" src="{{ asset('/web/js/jquery-3.4.1.min.js') }}"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="{{ asset('/web/js/popper.min.js') }}"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="{{ asset('/web/js/bootstrap.min.js') }}"></script>

	@yield('scripts')

	<!-- Scripts -->
	<script type="text/javascript" src="{{ asset('/web/js/script.js') }}"></script>
	@include('admin.partials.notifications')
</body>
</html>