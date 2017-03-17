@extends('login.layouts.auth')

@section('title','VADmin | Conectarse')

@section('content')
	
	<div class="centered-form">
		<div class="inner">
			{{-- Header --}}
			<div class="login-header">
				<span class="title">VADmin</span> <br> <span class="subtitle">Gestor de Operaciones</span>
			</div>
			{{-- Content --}}
			<form role="form" method="POST" action="{{ url('/login') }}">
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email">E-Mail</label>
					<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password">Contraseña</label>
					<input id="password" type="password" class="form-control" name="password" required>
					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Recordarme
					</label>
				</div>
				<div class="form-group">
					<div class="">
						<button type="submit" class="button buttonOk">
							Ingresar
						</button>
						<a href="{{ url('/register') }}">
							<button type="button" class="button buttonOther">Registrarse</button>
						</a>
						<a class="btn btn-link" href="{{ url('/password/reset') }}">
							Olvidó su contraseña?
						</a>
					</div>
				</div>
			</form>
			{{-- Footer --}}
			<div class="footer pull-right">
				<span>Desarrollado por </span> <br><img src="{{ asset('images/logos/logodark.png') }}">
			</div>
		</div>
	</div>
	

@endsection


@section('custom_js')

	<script type="text/javascript">
		$('body').addClass('login-back');
	</script>

@endsection

