@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Fletes')

@section('header')
	@section('header_title', 'Creación de Flete') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/fletes') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>
	@endsection
@endsection

@section('content')
	
	@component('vadmin.components.create')
		@slot('title', 'Agregar flete')
		@slot('form')
			{!! Form::open(['url' => 'vadmin/fletes', 'data-parsley-validate' => '']) !!}
				@include('vadmin.fletes.form')
				{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk']) !!}
			{!! Form::close() !!}
		@endslot
	@endcomponent

@endsection

@section('scripts')
	@include('vadmin.components.ajaxscripts')
@endsection
