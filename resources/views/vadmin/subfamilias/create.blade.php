@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Subfamilias')

@section('header')
	@section('header_title', 'Subfamilias') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/subfamilias') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

    @component('vadmin.components.create')
		@slot('title', 'Crear nueva subfamilia')
		@slot('form')
			{!! Form::open(['url' => 'vadmin/subfamilias', 'data-parsley-validate' => '']) !!}
				@include('vadmin.subfamilias.form')
                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk']) !!}
			{!! Form::close() !!}
		@endslot
	@endcomponent

@endsection
