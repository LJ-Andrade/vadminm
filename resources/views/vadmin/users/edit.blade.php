@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Editar Usuario')

@section('content')
<div class="container">
	<div class="row">
		<h2>Editando a <b>{{ $user->name}}</b></h2>
		<hr>
		{!! Form::open(['route' => ['users.update',$user->id], 'method' => 'PUT']) !!}
		{{-- {!! Form::open(['route' => 'users.update', $user->id, 'method' => 'PUT']) !!} --}}

			<div class="form-group">
				{!! Form::label('name', 'Nombre') !!}
				{!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Nombre de Usuario', 'required'] )!!}
			</div>
			<div class="form-group">
				{!! Form::label('email', 'E-Mail') !!}
				{!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'E-Mail', 'required'] )!!}
			</div>
			<div class="form-group">
				{!! Form::label('type', 'Tipo') !!}
				{!! Form::select('type', ['member' => 'Usuario', 'admin' => 'Administrador'], $user->type, ['class' => 'form-control'])!!}
			</div>
			<div class="form-group">
				{!! Form::submit('Editar Usuario', ['class' => 'btn btn-primary']) !!}
			</div>
			
		{!! Form::close() !!}
		
	</div>
</div>

@endsection