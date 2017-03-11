<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Somos un equipo de trabajo dedicado a desarrollar contenido visual e interactivo" />
	<meta name="keywords" content="Diseño Web, diseño grafico, web, sitio web, paginas web, programacion, sistemas, administracion, gestores, contenido, publicidad, internet, redes sociales" />
	<meta name="author" content="Studio Vimana" />

	<!-- Facebook and Twitter integration -->
	<meta property="og:url"         content="http://studiovimana.com.ar" />
	<meta property="og:type"        content="article" />
	<meta property="og:title"       content="Diseño Web y Diseño Gráfico" />
	<meta property="og:description" content="Somos un equipo de trabajo dedicado a desarrollar contenido visual e interactivo" />
	<meta property="og:image"       content="{{ asset('webimages/logos/main-logo.png') }}" />
	<meta name="twitter:title"      content="Studio Vimana" />
	<meta name="twitter:image"      content="{{ asset('webimages/logos/main-logo.png') }}" />
	<meta name="twitter:url"        content="http://studiovimana.com.ar" />
	{{-- <meta name="twitter:card"       content="" /> --}}

	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/animate/animate.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/ionicons/ionicons.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/web.css') }}">
	@yield('styles')
	@include('web.layouts.partials.analytics')
</head>
<body>
	<header>
		@include('web.layouts.partials.nav')
	</header>
	
    {{-- Loader --}}
    <div class="Loader loader">
        <img src="{{ asset('webimages/gral/loaders/loader.svg') }} ">
        <span><i class="ion-ios-gear-outline"></i> Cargando...</span>
    </div>
    {{-- /Loader --}}
	
	@yield('content')

	@include('web.layouts.partials.scripts')
	@yield('web.layouts.partials.js')
	@yield('scripts')
	@yield('custom_js')
</body>
</html>