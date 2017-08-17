
@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Tipos de Comprobante')

@section('header')
	@section('header_title', 'Creación de Tipos de Comprobante') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/tiposcomprobantes') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

	@component('vadmin.components.create')
		@slot('title', 'Nuevo tipo de comprobante')
		@slot('form')
			{!! Form::open(['url' => 'vadmin/tiposcomprobantes', 'data-parsley-validate' => '']) !!}
				@include('vadmin.tiposcomprobantes.form')
				{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk']) !!}
			{!! Form::close() !!}
		@endslot
	@endcomponent

@endsection

