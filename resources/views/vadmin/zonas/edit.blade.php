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

    <div class="container">
        <div id="Error"></div>
        <div id="" class="narrow-form">
            <div class="inner">
                <div class="title">
                    <span>Edición de zona</span>
                </div>
                {!! Form::model($zona, [
                    'method' => 'PATCH',
                    'url' => ['/vadmin/zonas', $zona->id],
                    'files' => true
                ]) !!}
                @include ('vadmin.zonas.form', ['submitButtonText' => 'Actualizar'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@endsection

