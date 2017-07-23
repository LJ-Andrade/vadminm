@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Zonas')

@section('header')
	@section('header_title', 'Creación de Zonas') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/zonas') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

	@component('vadmin.components.create')
		@slot('title', 'Creación de nueva zona')
		@slot('form')
			{!! Form::open(['url' => 'vadmin/zonas', 'data-parsley-validate' => '']) !!}
				@include('vadmin.zonas.form')
			{!! Form::close() !!}
		@endslot
	@endcomponent

</div>

@endsection
