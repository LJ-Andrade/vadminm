
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Clientes')

{{-- HEAD--}}
@section('header')
	@section('header_title')
		Hoja de Cliente
    @endsection 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/clientes') }}" class="btn btnSm buttonOther">Volver</a>
		</div>	
	@endsection
@endsection

{{-- STYLES--}}
@section('styles')
	{{-- Include Styles Here --}}
@endsection
{{-- CONTENT --}}
@section('content')
    <div class="container">
		<div class="row big-card">
		 	<div class="title">
				{{--  <span class="medium-text"></span> <br>--}}
			    <span class="big-text">{{ $cliente->razonsocial }}</span><br>
				<span class="small-text">Código: {{ $cliente->id }}</span>
            </div>


			<div class="content">
				<div class="row">
					<div class="col-md-6">
					  	<div class="subtitle">Datos </div>
						<b>Razón Social:</b>
						@if(is_null($cliente->razonsocial)) @else {{ $cliente->razonsocial }} @endif 
						<br>
						<b>Código de Cliente:</b>
						@if(is_null($cliente->id)) @else {{ $cliente->id }} @endif <br>
						<b>CUIT:</b>            
						@if(is_null($cliente->cuit)) @else {{ $cliente->cuit }} @endif<br>
						<b>Condición de Iva:</b>   
						@if(is_null($cliente->iva)) @else {{ $cliente->iva->name }} @endif
					</div>

					<div class="col-md-6">
					  	<div class="subtitle"> </div>
						<b>Dirección Fiscal:</b>   
						@if(is_null($cliente->dirfiscal)) @else {{ $cliente->dirfiscal }} @endif <br>
						<b>Provincia:</b>      
						@if(is_null($cliente->provincia)) @else {{ $cliente->provincia->name }} @endif <br>
						<b>Localidad:</b>    
						@if(is_null($cliente->localidad)) @else {{ $cliente->localidad->name }} @endif <br>
					</div>
				</div>
					<hr class="softhr">

				<div class="row">
					<div class="col-md-6">
						<b>Condiciones de Vta.:</b>
						@if(is_null($cliente->condicventas)) @else {{ $cliente->condicventas->name }} @endif <br>
						<b>Lista de Precios:</b>    
						@if(is_null($cliente->listas)) @else {{ $cliente->listas->name }} @endif <br>
						<b>Tipo:</b>    
	
						@if(is_null($cliente->tipoct->name)) @else {{ $cliente->tipoct->name }} @endif  <br>
						<b>Descuento:</b>    
						@if(is_null($cliente->descuento)) @else {{ $cliente->descuento }} @endif  
					</div>

					<div class="col-md-6">
						<b>Vendedor:</b>          
						@if(is_null($cliente->user)) @else {{ $cliente->user->name }} @endif <br>

						<b>Zona:</b>                
						@if(is_null($cliente->zona)) @else {{ $cliente->zona->name }} @endif <br>

						<b>Flete:</b>
						@if(is_null($cliente->flete)) @else {{ $cliente->flete->name }} @endif
					</div>
				</div>
				@if(count($cliente->direntregas)==0)
				@else
				<div class="row">
					<div class="col-md-12">
						<hr class="softhr">
						<div class="col-md-12">
							Direcciones de entrega:
						</div>
						@foreach($cliente->direntregas as $direntrega)	
						<div class="col-md-3 small-card-filled">
							<b>{{ $direntrega->name }} </b><br>
							{{ $direntrega->provincia->name }} <br>
							{{ $direntrega->localidad->name }} <br>
							{{ $direntrega->telefono }} <br>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			@endif
			
			
		</div>
		
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	<div id="Error"></div>	
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
@endsection