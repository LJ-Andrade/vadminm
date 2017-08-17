@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Tipos Comprobantes')

@section('header')
	@section('header_title', 'Edición de Tipos de Comprobantes') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/tiposcomprobantes') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	    
	@endsection
@endsection

@section('content')
    <div class="container">
        <div id="Error"></div>
        <div class="narrow-form">
            <div class="inner">
                <div class="title">
                    <span>Edición</span>
                </div>
                {!! Form::model($tiposcomprobante, [
                    'method' => 'PATCH',
                    'url' => ['/vadmin/tiposcomprobantes', $tiposcomprobante->id],
                    'files' => true
                ]) !!}
                @include('vadmin.tiposcomprobantes.form')
                {!! Form::submit('Editar', ['class' => 'button btnGreen']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection