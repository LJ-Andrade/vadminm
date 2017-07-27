@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Localidades')

@section('header')
	@section('header_title', 'Creación de Localidad') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/localidades') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	    
	@endsection
@endsection

@section('content')
    <div class="container">
        <div id="Error"></div>
        <div class="narrow-form">
            <div class="inner">
                <div class="title">
                    <span>Edición de localidad</span>
                </div>
                {!! Form::model($localidad, [
                    'method' => 'PATCH',
                    'url' => ['/vadmin/localidades', $localidad->id],
                    'files' => true
                ]) !!}
                @include('vadmin.localidades.form')
                {!! Form::submit('Editar Localidad', ['class' => 'button btnGreen']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
