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
    <div class="container">
        <div id="Error"></div>
        <div class="narrow-form">
            <div class="inner">
                <div class="title">
                    <span>Edición de subfamilia</span>
                </div>
                {!! Form::model($subfamilia, [
                    'method' => 'PATCH',
                    'url' => ['/vadmin/subfamilias', $subfamilia->id],
                    'files' => true
                ]) !!}
                @include('vadmin.subfamilias.form')
                {!! Form::submit('Actualizar subfamilia', ['class' => 'button btnGreen']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

