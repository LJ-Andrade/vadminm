@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Iva')

@section('header')
	@section('header_title', 'Categorías Impositivas') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/ivas') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection


@section('content')

	@component('vadmin.components.create')
		@slot('title', 'Creación de categoría impositiva')
		@slot('form')
			{!! Form::open(['url' => 'vadmin/ivas', 'data-parsley-validate' => '']) !!}
				@include('vadmin.ivas.form')
			{!! Form::close() !!}
		@endslot
	@endcomponent

@endsection
