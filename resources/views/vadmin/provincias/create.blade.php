@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Provincias')

@section('header')
	@section('header_title', 'Creación de Provincia') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/provincias') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('content')

	@component('vadmin.components.create')
		@slot('title', 'Creación de nueva provincia')
		@slot('form')
			{!! Form::open(['url' => 'vadmin/provincias', 'data-parsley-validate' => '']) !!}
				@include('vadmin.provincias.form')
			{!! Form::close() !!}
		@endslot
	@endcomponent

@endsection
