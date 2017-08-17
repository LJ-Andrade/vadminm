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
    <div class="container">
        <div id="Error"></div>
        <div class="narrow-form">
            <div class="inner">
                <div class="title">
                    <span>Edición de flete</span>
                </div>
                {!! Form::model($familia, [
                    'method' => 'PATCH',
                    'url' => ['/vadmin/familias', $familia->id],
                    'files' => true
                ]) !!}
                @include('vadmin.familias.form')
                {!! Form::submit('Actualizar familia', ['class' => 'button btnGreen']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

