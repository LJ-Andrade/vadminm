<nav class="navbar navbar-inverse navbar-fixed-top">
	 <div class="container-fluid">
		  <div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#expand-nav" aria-expanded="false">
					 <span class="sr-only">toggle navigation</span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
				</button>
		  </div>
		  <div class="collapse navbar-collapse" id="expand-nav">
				<ul class="nav navbar-nav navbar-left"> 
					 {{-- <li><a href="{{ url('/vadmin') }}">VADmin | Panel de Control</a></li> --}}
					 <li><a href="{{ url('/vadmin') }}"><img src="{{ asset('images/logos/vadminlogo.png') }}" class="img-responsive" alt=""></a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					 <li class="dropdown user-menu">
						  @if((Auth::user()==null))
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<img style="width: 30px; margin-right: 5px; border-radius: 100%; padding: 0"
									 src="{{ asset('images/gen/user-gen.jpg') }}">
								{{ 'Who Are you?' }}
								<span class="caret"></span>
						  </a>
						  @else
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">				
						  		@if(Auth::user()->avatar == '')
								<img style="width: 30px; margin-right: 5px; border-radius: 100%; padding: 0"
									 src="{{ asset('images/gen/user-gen.jpg') }}">
								@else
								<img style="width: 30px; margin-right: 5px; border-radius: 100%; padding: 0"
									 src="{{ asset('images/users/'.Auth::user()->avatar) }}">
								@endif
								{{ Auth::user()->name }}
								<span class="caret"></span>
						  </a>
						  @endif 
						  <ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/profile') }}"><i class="ion-android-person"></i> Perfil</a></li>
								<li>
									<a href="{{ url('/logout') }}"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();"><i class="ion-log-out"></i> Desconectarse</a>
									<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>
						  </ul>
					 </li>
				</ul>
				@if ( Auth::user()->type =='superadmin' or Auth::user()->type =='admin' )
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Nuevo
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{ route('facturas.create') }}"><i class="ion-printer"></i>Factura</a></li>
							<li><a href="{{ route('productos.create') }}"><i class="ion-cube"></i>Producto</a></li>
							<li><a href="{{ route('pedidos.create') }}"><i class="ion-paper-airplane"></i>Pedido</a></li>
							<li><a href="{{ route('reparaciones.create') }}"><i class="ion-wrench"></i> Reparación</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('clientes.create') }}"><i class="ion-ios-briefcase"></i>Cliente</a></li>
							<li><a href="{{ route('proveedores.create') }}"><i class="ion-ios-people"></i> Proveedor</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Listados
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
						    <li><a href="{{ route('facturas.index') }}"><i class="ion-printer"></i>Facturas</a></li>
							<li><a href="{{ route('pedidos.index') }}"><i class="ion-paper-airplane"></i> Pedidos</a></li>
							<li><a href="{{ route('reparaciones.index') }}"><i class="ion-wrench"></i> Reparaciones</a></li>
							<li><a href="{{ route('productos.index') }}"><i class="ion-cube"></i> Productos</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('clientes.index') }}"><i class="ion-ios-briefcase"></i> Clientes</a></li>
							<li><a href="{{ route('proveedores.index') }}"><i class="ion-ios-people"></i> Proveedores</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('listas.index') }}"><i class="ion-clipboard"></i> Listas de Precios</a></li>
							<li><a href="{{ route('users.index') }}"><i class="ion-ios-people"></i> Usuarios</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Varios
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{ route('proveedores.index') }}"><i class="ion-ios-people"></i> Proveedores</a></li>
							<li><a href="{{ route('familias.index') }}"><i class="ion-ios-people"></i> Familias</a></li>
							<li><a href="{{ route('subfamilias.index') }}"><i class="ion-ios-people"></i> SubFamilias</a></li>
							<li><a href="{{ route('tipocts.index') }}"><i class="ion-ios-people"></i> Tipo de Cliente</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('pedidositems.index') }}"><i class="ion-ios-people"></i> Pedidos Items</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('condicventas.index') }}"><i class="ion-clipboard"></i> Condiciones de Vta.</a></li>
							<li><a href="{{ route('ivas.index') }}"><i class="ion-ios-list-outline"></i> Categorías Iva</a></li>
							<li><a href="{{ route('monedas.index') }}"><i class="ion-social-usd"></i> Monedas</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('direntregas.index') }}"><i class="ion-android-pin"></i> Direcciones de Entrega</a></li>
							<li><a href="{{ route('fletes.index') }}"><i class="ion-paper-airplane"></i> Fleteros</a></li>
							<li><a href="{{ url('vadmin/vendedores') }}"><i class="ion-ios-people"></i> Vendedores</a></li>
							<li><a href="{{ route('zonas.index') }}"><i class="ion-map"></i> Zonas</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('provincias.index') }}"><i class="ion-map"></i> Provincias</a></li>
							<li><a href="{{ route('localidades.index') }}"><i class="ion-map"></i> Localidades</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{ url('/') }}"><i class="ion-ios-monitor-outline"></i> Ver Web</a></li>
							<li><a href="https://trello.com/b/mxWo2W9W/vadminm" target="_blank"><i class="ion-paper-airplane"></i> Mapa de Desarrollo</a></li>
						</ul>
					</li>
				</ul>
				@else
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Nuevo
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
						{{-- 	<li><a href="{{ route('facturas.create') }}"><i class="ion-printer"></i>Factura</a></li> --}}
							<li><a href="{{ route('productos.create') }}"><i class="ion-cube"></i>Producto</a></li>
							<li><a href="{{ route('pedidos.create') }}"><i class="ion-paper-airplane"></i>Pedido</a></li>
							<li><a href="{{ route('reparaciones.create') }}"><i class="ion-wrench"></i> Reparación</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('clientes.create') }}"><i class="ion-ios-briefcase"></i>Cliente</a></li>
							<li><a href="{{ route('proveedores.create') }}"><i class="ion-ios-people"></i> Proveedor</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Listados
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
							{{-- <li><a href="{{ route('facturas.index') }}"><i class="ion-printer"></i>Facturas</a></li> --}}
							<li><a href="{{ route('pedidos.index') }}"><i class="ion-paper-airplane"></i> Pedidos</a></li>
							<li><a href="{{ route('reparaciones.index') }}"><i class="ion-wrench"></i> Reparaciones</a></li>
							<li><a href="{{ route('productos.index') }}"><i class="ion-cube"></i> Productos</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('clientes.index') }}"><i class="ion-ios-briefcase"></i> Clientes</a></li>
							<li><a href="{{ route('proveedores.index') }}"><i class="ion-ios-people"></i> Proveedores</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('listas.index') }}"><i class="ion-clipboard"></i> Listas de Precios</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Varios
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('direntregas.index') }}"><i class="ion-android-pin"></i> Direcciones de Entrega</a></li>
							<li><a href="{{ route('fletes.index') }}"><i class="ion-paper-airplane"></i> Fleteros</a></li>
						</ul>
					</li>
				</ul>
				@endif
		  </div>
	 </div>
</nav>

