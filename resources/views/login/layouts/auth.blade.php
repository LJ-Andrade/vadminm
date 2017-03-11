<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'VADmin | Login') }}</title> --}}

    <!-- Styles -->
    {{-- <link href="/css/app.css" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/ionicons/ionicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vadmin.css')}}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="login-back">
    <div id="app">
        {{-- @include('layouts.includes.nav') --}}

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('plugins/jquery/jquery-3.3.1.min.js') }}" ></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    @yield('custom_js')
</body>
</html>
