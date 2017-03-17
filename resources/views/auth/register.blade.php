@extends('login.layouts.auth')

@section('content')

<div class="centered-form">
		<div class="inner">
			{{-- Header --}}
			<div class="login-header">
				<span class="title">VADmin</span> <br> <span class="subtitle">Gestor de Operaciones</span>
                <div class="formname"><span>Registro de Nuevo Usuario</span></div>
			</div>
			{{-- Content --}}
			 <form role="form" method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="name">Nombre</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail</label>            
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                <div class="form-group">
                    <label for="password-confirm">Confirmar Contraseña</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
                <div class="form-group">
					<div class="">
						<button type="submit" class="button buttonOk">
							Registrarse
						</button>
						<a href="{{ url('/login') }}">
							<button type="button" class="button buttonOther">Volver</button>
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
