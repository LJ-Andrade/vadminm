@extends('vadmin.layouts.main')

@section('title', 'VADmin | Perfil')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
	            <h2>Usuario: {{ $user->name }}</h2>
	            <img src="images/users/{{ $user->avatar }}">
	            <br>
	            <label>Cambiar imágen</label>
	            {!! Form::open(['url' => 'profile', 'method' => 'POST', 'files' => true]) !!}
	            {{-- <form enctype="multipart/form-data" action="profile" method="POST"> --}}
		            <input type="file" name="avatar">
		            <input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
		            <input type="submit" class="btn btn-sm btn-primary" value="Cambiar">
	            {!! Form::close() !!}
	            {{-- </form> --}}
            </div>
        </div>
    </div>
@endsection
