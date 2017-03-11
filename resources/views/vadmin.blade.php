@extends('vadmin.layouts.main')
@section('title', 'Vadmin | Mataderos Distribuciones')
{{-- @section('header_title', 'Panel de Control | ')  --}}
@section('header_subtitle', 'Inicio')


@section('content')

	 <div class="container">
		<div class="row">
		<span>Bienvenido <b>{{ Auth::user()->name }}.</b></span><br>
		<span>Tu nivel de permisos es <b>{{ roleTrd(Auth::user()->type) }}</b></span> <br>
			
		</div>
	 </div>  

@endsection






