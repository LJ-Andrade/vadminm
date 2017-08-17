
@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Movimiento')

@section('header')
	@section('header_title', 'Creación de Movimiento') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/movimientos') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

	@component('vadmin.components.create')
		@slot('title', 'Creación de nueva Movimiento')
		@slot('form')
			{!! Form::open(['url' => 'vadmin/movimientos', 'data-parsley-validate' => '']) !!}
				@include('vadmin.movimientos.form')
				{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk']) !!}
			{!! Form::close() !!}
		@endslot
	@endcomponent

@endsection

