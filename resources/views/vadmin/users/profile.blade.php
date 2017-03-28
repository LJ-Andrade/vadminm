@extends('vadmin.layouts.main')

@section('title', 'VADmin | Perfil de Usuario')

@section('header')
	@section('header_title', 'Perfil de Usuario') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/users') }}" class="btn btnSm buttonOther">Listado de Usuarios</a>
		</div>	
	@endsection
@endsection

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12 profile-card">
				<div class="inner">
					<div class="title"><span class="data">{{ $user->name }}</span></div>
					<div id="Avatar">
						@if($user->avatar == '')
							<img src="images/gen/user-gen.jpg" class="Image-Container">
						@else	
							<img src="images/users/{{ $user->avatar }}" class="Image-Container">
						@endif
					</div>

					<div class="text">
						<div><span><b>{{ $user->email }}</b></span>
						<hr class="softhr">
						<div><span><b>Permisos</b></span>
						<span class="data">{{ typeTrd($user->type) }}</span></div>
						<div><span><b>Rol</b></span> <span class="data">{{ roleTrd($user->role) }}</span></div>
					</div>
					<br>
					{!! Form::open(['url' => 'profile', 'method' => 'POST', 'files' => true]) !!}
					{{-- <form enctype="multipart/form-data" action="profile" method="POST"> --}}
						<input type="file" name="avatar" class="Hidden" id="ImageInput">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="submit" class="button buttonOk animated fadeIn Hidden" id="ConfirmChange" value="Confirmar">
					{!! Form::close() !!}
					{{-- </form> --}}
				</div>
			</div>
		</div>
	</div>

@endsection



@section('custom_js')
	
	<script>
		$(document).ready(function() {
			$('#Avatar').click(function(){
				$('#ImageInput').click();
			});       
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('.Image-Container').attr('src', e.target.result);
				}
					reader.readAsDataURL(input.files[0]);
				}
			}
			$("#ImageInput").change(function(){
			readURL(this);
			$('#ConfirmChange').removeClass('Hidden');
		});

	
	</script>

@endsection