@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Tags')
@section('header_title', 'Listado') 
@section('header_subtitle', 'de Tags') 

@section('content')

	<div class="container">
		<div class="row">
			<a href="{{ route('tags.create') }}" class="btn btn-success">Nuevo Tag</a>
			{{-- Search --}}
			{!! Form::open(['route' => 'tags.index', 'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}
				<div class="input-group">
					{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar tag...', 'aria-describedby' => 'search']) !!}
					<span class="input-group-addon" id="search">
						<span class="ion-ios-search" aria-hidden="true"></span>
					</span>
				</div>
			{!! Form::close() !!}
			{{-- /Search --}}
			<hr>
		    <table class="table table-striped">
				<thead>
				  <tr>
				    <th>Id</th>
				    <th>Nombre</th>
				  </tr>
				</thead>
				<tbody>
					@foreach($tags as $tag)
					<tr>
						<td>{{ $tag->id }}</td>
						<td>{{ $tag->name }}</td>
						<td>
						<a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-success"><i class="ion-edit"></i></a>
						<a href="{{ route('tags.destroy', $tag->id) }}" onclick="return confirm('Seguro que deseas eliminar el tag?')" class="btn btn-danger"><i class="ion-trash-b"></i></a>
						</td>
					</tr>
					@endforeach		
					@if(!$tags->all())
					<tr>
						<td>{!! 'No hay tags creadas' !!}</td>
						<td></td>
					</tr>
					@endif
				</tbody>
			</table>
			{!! $tags->render(); !!}
		</div>
	</div>  

@endsection