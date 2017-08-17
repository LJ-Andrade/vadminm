@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Familias')

@section('header')
	@section('header_title', 'Familias') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/familias') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

    @component('vadmin.components.create')
		@slot('title', 'Crear nueva familia')
		@slot('form')
			{!! Form::open(['url' => 'vadmin/familias', 'data-parsley-validate' => '']) !!}
				@include('vadmin.familias.form')
                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk']) !!}
			{!! Form::close() !!}
		@endslot
	@endcomponent

@endsection
