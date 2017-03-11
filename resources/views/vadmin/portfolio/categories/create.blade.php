@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Creación de Usuario')

@section('content')
	
	<div class="container">
		<div class="row">
			{!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
				<div class="form-group">
					{!! Form::label('name', 'Nombre') !!}
					{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la categoría', 'required']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>	

@endsection