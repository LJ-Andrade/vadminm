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

	@component('vadmin.components.create')
		@slot('title')
			<i class="ion-edit"></i> Editando Categoría {{ $categoria->nombre }}
		@endslot

		
		@slot('form')
			{!! Form::model($categoria, [
                    'method' => 'PATCH',
                    'url' => ['vadmin/categorias', $categoria->id],
                    'files' => true
                ]) !!}
                @include('vadmin.categorias.form')
                {!! Form::submit('Editar', ['class' => 'button btnGreen']) !!}
                {!! Form::close() !!}
		@endslot
	@endcomponent

@endsection