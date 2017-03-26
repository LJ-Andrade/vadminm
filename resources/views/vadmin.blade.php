@extends('vadmin.layouts.main')
@section('title', 'Vadmin | Mataderos Distribuciones')
@section('header_title', 'Inicio | ')
@section('header_subtitle')
	Bienvenido <b>{{ Auth::user()->name }}</b>
@endsection

@section('content')

	 <div class="container">
		<div class="row">
		
			<span>Tu nivel de permisos es <b>{{ roleTrd(Auth::user()->type) }}</b></span><br>
			
		</div>
	 </div>  

@endsection






