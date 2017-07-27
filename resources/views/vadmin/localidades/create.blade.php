@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Localidades')

@section('header')
	@section('header_title', 'Creación de Localidad') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/localidades') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('content')

	@component('vadmin.components.create')
		@slot('title', 'Creación de Localidad')
		@slot('form')
			{!! Form::open(['url' => 'vadmin/localidades', 'data-parsley-validate' => '']) !!}
				@include('vadmin.localidades.form')
				{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk']) !!}
			{!! Form::close() !!}
		@endslot
	@endcomponent

@endsection
