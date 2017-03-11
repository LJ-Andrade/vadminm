<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="VADmin | Gestor de Contenidos" />
	<meta name="keywords" content="Diseño Web, diseño grafico, web, sitio web, paginas web, programacion, sistemas, administracion, gestores, contenido, publicidad, internet, redes sociales" />
	<meta name="author" content="Studio Vimana" />

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('webimages/logos/favicon.png') }}">

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/animate/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/ionicons/ionicons.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/validation/parsley.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/sweetalert/sweetalert2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/chosen/chosen.min.css') }}">
	@yield('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/vadmin.css') }}">
</head>
	<body>
		@include('vadmin.layouts.partials.full')
		<header>
			@include('vadmin.layouts.partials.nav')
		</header>
		@include('vadmin.layouts.partials.header')
		{{-- @yield('modal') --}}
		<section class="main-section">
			<div class="container">
				@include('vadmin.users.searcher')
				@include('vadmin.layouts.partials.errors')
				@include('vadmin.layouts.partials.messages')
			</div>
			{{-- Content --}}
			@yield('content')
			{{-- /Content --}}
		</section>

		<script type="text/javascript" src="{{ asset('plugins/jquery/jquery-3.3.1.min.js') }}" ></script>
		<script type="text/javascript" src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" ></script>
		<script type="text/javascript" src="{{ asset('plugins/sweetalert/sweetalert2.min.js') }}" ></script>
		<script type="text/javascript" src="{{ asset('plugins/validation/parsley.min.js') }}" ></script>
		<script type="text/javascript" src="{{ asset('plugins/validation/es/parsley-es.min.js') }}" ></script>
		<script type="text/javascript" src="{{ asset('plugins/chosen/chosen.jquery.min.js') }}" ></script>
		@yield('scripts')
		<script type="text/javascript" src="{{ asset('js/jslocal/vadmin.js') }}" ></script>
		@yield('custom_js')
	</body>
</html>