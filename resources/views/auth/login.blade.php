@extends('login.layouts.auth')

@section('title','VADmin | Conectarse')

@section('content')

	<div class="main-form outer-wrapper">
		<div class="container">
			<div class="row form-container login-container">
				<div class="inner-wrapper inner">
					<div class="login-header"><img src="{{ asset('images/logos/logodark.png') }}"></div>
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
								<a href="{{ url('/register') }}"  class="button buttonOther">
									Registrarse							
								</a>
								<a class="btn btn-link" href="{{ url('/password/reset') }}">
									Olvidó su contraseña?
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>



@endsection


@section('custom_js')

	<script type="text/javascript">
		$('body').addClass('login-back');
	</script>

@endsection

