@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Tipocts')

@section('header')
	@section('header_title', 'Creación de Tipocts') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/tipocts') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
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
                    <span>Edición de tipo de cliente</span>
                </div>
                {!! Form::model($tipoct, [
                    'method' => 'PATCH',
                    'url' => ['/vadmin/tipocts', $tipoct->id],
                    'files' => true
                ]) !!}
                @include ('vadmin.tipocts.form', ['submitButtonText' => 'Update'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@endsection

