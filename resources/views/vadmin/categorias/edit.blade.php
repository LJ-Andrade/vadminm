@extends('vadmin.layouts.main')

@section('title', 'Vadmin | categorias')

@section('header')
	@section('header_title', 'categorias') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/categorias') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
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
                {!! Form::model($categoria, [
                    'method' => 'PATCH',
                    'url' => ['vadmin/categorias', $categoria->id],
                    'files' => true
                ]) !!}
                @include('vadmin.categorias.form')
                {!! Form::submit('Editar', ['class' => 'button btnGreen']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection