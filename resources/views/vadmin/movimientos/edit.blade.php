@extends('vadmin.layouts.main')

@section('title', 'Vadmin | movimientos')

@section('header')
	@section('header_title', 'movimientos') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/movimientos') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
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
                {!! Form::model($movimiento, [
                    'method' => 'PATCH',
                    'url' => ['/vadmin/movimientos', $movimiento->id],
                    'files' => true
                ]) !!}
                @include('vadmin.vadmin.movimientos.form')
                {!! Form::submit('Editar', ['class' => 'button btnGreen']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection