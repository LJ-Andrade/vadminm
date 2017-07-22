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

@section('styles')
	
@endsection

@section('content')

<div class="container">
    <div id="Error"></div>
    <div  class="narrow-form">
		<div class="inner">
			<div class="title">
				<span>Creación de nueva categoría impositiva</span>
			</div>
			{!! Form::open(['url' => 'vadmin/ivas', 'data-parsley-validate' => '']) !!}
				@include('vadmin.ivas.form')
				{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk']) !!}
			{!! Form::close() !!}
		</div>
    </div>
</div>

@endsection
