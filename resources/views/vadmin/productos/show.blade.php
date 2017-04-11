
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Productos')

{{-- HEAD--}}
@section('header')
	@section('header_title')
		Hoja de Producto
    @endsection 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/productos') }}" class="btn btnSm buttonOther">Volver</a>
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
			    <h1>@if(is_null($producto->nombre)) @else {{ $producto->nombre }} @endif </h1>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="subtitle">Datos</div>
                        <b>Código: </b>  {{ $fullid }} <br>
                        <b>Familia: </b>  @if(is_null($producto->familia->nombre)) @else {{ $producto->familia->nombre }} @endif <br>
                        <b>Subfamilia: </b>  @if(is_null($producto->subfamilia->nombre)) @else {{ $producto->subfamilia->nombre }} @endif <br>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="subtitle">Proveedor</div>
                        <b>Proveedor:</b> @if(is_null($producto->proveedor->nombre)) @else {{ $producto->proveedor->nombre }} @endif <br>
                        <b>Código de proveedor:</b> @if(is_null($producto->codproveedor)) @else {{ $producto->codproveedor }} @endif  <br>
                        <b>Condición de iva:</b> @if(is_null($producto->condiva)) @else {{ $producto->condiva }} %@endif <br>
                    </div>
                </div>
                <hr class="softhr">
                <div class="row">
                    <div class="col-md-6">
                        <div class="subtitle">Precios en Dólares</div>
                        <b>Precio de costo: u$s</b> @if(is_null($producto->preciocosto)) @else {{ $producto->preciocosto }} @endif <br>
                        <b>Gremio</b> @if(is_null($producto->pjegremio)) @else {{ $producto->pjegremio }} % @endif | <b>u$s</b> {{ $valgremiouss }} <br>
                        <b>Particular:</b> @if(is_null($producto->pjeparticular)) @else {{ $producto->pjeparticular }} % @endif | <b>u$s: </b>{{ $valparticularuss }} <br>
                        <b>Especial:</b> @if(is_null($producto->pjeespecial)) @else {{ $producto->pjeespecial }} % @endif | <b>u$s</b> {{ $valespecialuss }} </b><br>                
                        <button class="btnSm buttonOther">Actualizar Costo</button>
                    </div>
                    <div class="col-md-6">
                        <div class="subtitle">Precios en Pesos</div>
                        <b>Precio de costo: $</b> {{ $preciocostopesos }} <br>
                        <b>Gremio</b> @if(is_null($producto->pjegremio)) @else {{ $producto->pjegremio }} % @endif | <b>$</b> {{ $valorgremio }} <br>
                        <b>Particular:</b> @if(is_null($producto->pjeparticular)) @else {{ $producto->pjeparticular }} % @endif | <b>$ </b>{{ $valorparticular }} <br>
                        <b>Especial:</b> @if(is_null($producto->pjeespecial)) @else {{ $producto->pjeespecial }} % @endif | <b>$</b> {{ $valorespecial }} </b><br>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="subtitle">Stock </div>
                        <b>Stock actual:</b> @if(is_null($producto->stockactual)) @else {{ $producto->stockactual }} @endif <br>
                        <b>Stock mínimo:</b> @if(is_null($producto->stockmin)) @else {{ $producto->stockmin }} @endif <br>
                        <b>Stock máximo:</b> @if(is_null($producto->stockmax)) @else {{ $producto->stockmax }} @endif <br>
                        <button class="btnSm buttonOther">Actualizar Stock</button>
                    </div>
                    <div class="col-md-6">
                        <div class="subtitle">Ofertas</div>
                        <b>Precio de oferta:</b> @if(is_null($producto->preciooferta)) @else u$s {{ $producto->preciooferta }} @endif | @if(is_null($precioofertapesos)) @else $ {{ $precioofertapesos }} @endif <br>
                        <b>Cantidad mínima (oferta):</b> @if(is_null($producto->cantoferta)) @else {{ $producto->cantoferta }} @endif <br>
                    </div>
                </div>
                <hr class="softhr">
                <b>Estado en lista:</b> @if(is_null($producto->estado)) @else {{ $producto->estado }} @endif <br>
                <hr class="softhr">
			</div> {{-- /Content --}}
                    
            <div class="right-bottom">
                <span class="small-text">Última actualización: <b>{{ transDateT($producto->updated_at) }}</b></span><br>
                <button class="btnSm buttonOk">Editar Producto</button> 
            </div>
		</div> {{-- /Row Big-Card --}}
	</div> {{-- /Container --}}
	<div id="Error"></div>	
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
@endsection