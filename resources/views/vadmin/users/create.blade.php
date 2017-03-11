@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Creación de Usuario')

@section('content')
<div class="container">
	<div class="row">
		<h2>Creación de Usuario</h2>
		<hr>
		{!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}

			<div class="form-group">
				{!! Form::label('name', 'Nombre') !!}
				{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de Usuario', 'required'] )!!}
			</div>
			<div class="form-group">
				{!! Form::label('email', 'E-Mail') !!}
				{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-Mail', 'required'] )!!}
			</div>
			<div class="form-group">
				{!! Form::label('password', 'Contraseña') !!}
				{!! Form::password('password', ['class' => 'form-control', 'placeholder' => '*********', 'required'] )!!}
			</div>
			<div class="form-group">
				{!! Form::label('type', 'Tipo') !!}
				{!! Form::select('type', ['member' => 'Usuario', 'admin' => 'Administrador'], null, 
				['class' => 'form-control', 'placeholder' => 'Seleccione una opción...', 'required'])!!}
			</div>
			<div class="form-group">
				{!! Form::submit('Agregar Usuario', ['class' => 'btn btn-primary']) !!}
			</div>
			
		{!! Form::close() !!}
		
	</div>
</div>

@endsection