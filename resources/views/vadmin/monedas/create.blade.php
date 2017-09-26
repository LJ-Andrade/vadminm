@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Monedas')

@section('header')
	@section('header_title', 'Creación de Monedas') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/monedas') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

    @component('vadmin.components.create')
		@slot('title', 'Creación de Moneda')
		@slot('form')
			{!! Form::open(['url' => 'vadmin/monedas', 'data-parsley-validate' => '']) !!}
				@include('vadmin.monedas.form')
                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button btnGreen']) !!}
			{!! Form::close() !!}
		@endslot
	@endcomponent

@endsection
