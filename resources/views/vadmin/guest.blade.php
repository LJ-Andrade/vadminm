@extends('vadmin.layouts.main')
@section('title', 'Vadmin | Mataderos Distribuciones')
@section('header_title', 'Inicio | ')
@section('header_subtitle')
Bienvenido <b>{{ Auth::user()->name }}</b>
@endsection


@section('content')

	 <div class="container">
		<div class="row">
		
		<span>Tu rol en el sistema es: <b>{{ roleTrd(Auth::user()->type) }}</b></span> <br>
        <hr>
        Al momento no puedes realizar tareas en el sistema. <br>
        Para hacerlo debes solicitar a los administradores del sistema que te den los permisos acordes a tu función.
			
		</div>
	 </div>  

@endsection




