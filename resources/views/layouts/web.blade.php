<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>

	<link rel="icon" href="{{ asset('/admins/img/pelota.ico') }}" type="image/x-icon" />

	<meta name="robots" content="index,follow" />
	<meta property="og:url" content="{{ url()->current() }}" />
	<meta property="og:type" content="@yield('ogtype', 'website')" />
	<meta property="og:title" content="@yield('title')" />
	<meta property="og:description" content="@yield('ogdescription')" />
	<meta property="og:image" content="@yield('ogimage')" />
	<meta name="description" content="@yield('ogdescription')">
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="{{ "@Desdelbanquill" }}" />
	<meta name="twitter:creator" content="{{ "@Desdelbanquill" }}" />

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

	@if(!session()->has('user'))
	@include('web.partials.login')
	@include('web.partials.register')
	@include('web.partials.recovery')
	@endif

	<!-- JQuery -->
	<script type="text/javascript" src="{{ asset('/web/js/jquery-3.4.1.min.js') }}"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="{{ asset('/web/js/popper.min.js') }}"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="{{ asset('/web/js/bootstrap.min.js') }}"></script>

	@yield('scripts')

	<!-- Scripts -->
	<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
	<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
	<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
	<script src="{{ asset('/admins/js/validate.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/web/js/script.js') }}"></script>
	@include('admin.partials.notifications')
	@if(!session()->has('user'))
	@if(!is_null(old('name')) && !is_null(old('lastname')) && !is_null(old('email')))
	<script type="text/javascript">
		$('#modal-register').modal('show');
	</script>
	@elseif(!is_null(old('email')))
	<script type="text/javascript">
		$('#modal-login').modal('show');
	</script>
	@elseif(!is_null(old('recovery')) || session('error.recovery') || session('success.recovery'))
	<script type="text/javascript">
		$('#modal-recovery').modal('show');
	</script>
	@endif
	@endif
</body>
</html>