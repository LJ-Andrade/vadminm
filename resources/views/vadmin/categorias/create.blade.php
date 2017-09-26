
@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Categoria')

@section('header')
	@section('header_title', 'Creación de Categoria') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/categorias') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

	@component('vadmin.components.create')
		@slot('title')
			<i class="ion-plus-circled"></i> Nueva Categoría
		@endslot
		@slot('form')
			{!! Form::open(['url' => 'vadmin/categorias', 'data-parsley-validate' => '']) !!}
				@include('vadmin.categorias.form')
				{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button btnGreen']) !!}
				
			{!! Form::close() !!}
		@endslot
	@endcomponent

@endsection

