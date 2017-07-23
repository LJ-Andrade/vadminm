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
        <div class="narrow-form">
            <div class="inner">
                <div class="title">
                    <span>Creación de nueva categoría impositiva</span>
                </div>
                {!! Form::model($iva, [
                    'method' => 'PATCH',
                    'url' => ['/vadmin/ivas', $iva->id],
                    'files' => true
                ]) !!}
                @include('vadmin.ivas.form')
                {!! Form::submit('Editar Categoría', ['class' => 'button btnGreen']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@endsection

