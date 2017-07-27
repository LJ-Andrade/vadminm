@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Edición de Provincia')

@section('header')
	@section('header_title', 'Edición de Provincia') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/provincias') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	    
	@endsection
@endsection

@section('content')
    <div class="container">
        <div id="Error"></div>
        <div id="" class="narrow-form">
            <div class="inner">
                <div class="title">
                    <span>Edición de provincia</span>
                </div>
                {!! Form::model($provincia, [
                    'method' => 'PATCH',
                    'url' => ['/vadmin/provincias', $provincia->id],
                    'files' => true
                ]) !!}
                @include ('vadmin.provincias.form', ['submitButtonText' => 'Actualizar'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
