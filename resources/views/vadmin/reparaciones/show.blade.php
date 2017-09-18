
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Reparaciones')

{{-- HEAD--}}
@section('header')
	@section('header_title')
		Hoja de Reparación
    @endsection 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/reparaciones') }}" class="btn btnSm buttonOther">Volver</a>
		</div>	
	@endsection
@endsection

{{-- STYLES--}}
@section('styles')
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}	
@endsection
{{-- CONTENT --}}
@section('content')
    <div class="container">
		<input type="text" id="Operacion" class="Hidden" value="pedido">{{-- This shows product data display--}}
        <div id="Error"></div>
		<div class="row big-card">
		 	<div class="title">
			    <h2>Cliente: {{ $reparacion->cliente->razonsocial}}</h2>
				<div id="ClientData" data-reparacionid="{{ $reparacion->id }}" data-clientid="{{ $reparacion->cliente->id }}"></div>
				<div id="TipoCte" class="small-text" data-tipocte="{{ $reparacion->cliente->tipo_id }}"><b>Tipo de cliente: </b>{{ $tipocte }}</div>
				<div class="small-text"><b>Pedido N°: </b> {{ $reparacion->id }} </div>
				<div class="right text-right"><b>Creado el</b> {{ transDateT($reparacion->created_at) }} <br> <b>Autor:</b> {{ $reparacion->user->name }}</div>
            </div>		
			<div class="content">
				<div class="row">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Cod.</th>
									<th>Producto</th>
									<th>Cantidad</th>
									<th>P.Unit.</th>
									<th class="txR">SubTotal</th>
									<th class="txR">Facturado</th>
									<th></th>
								</tr>
							</thead>
							
							<tbody>
								@if ($reparacion->reparacionesitems->isEmpty() )
									<th>No hay items ingresados</th>
								@else
								@foreach($reparacion->reparacionesitems as $item)
								<tr id="Id{{ $item->id }}" class="item-row">
									<td>{{ $item->producto->id }}</td>
									<td>{{ $item->producto->nombre }}</td>
									<td>{{ $item->cantidad }}</td>
									<td>$ {{ $item->valor }}</td>
									<td class="txR">$ {{ $item->cantidad * $item->valor }}</td>
									<td class="txR">
										@if( $item->facturado == 1)
											<i class="ion-checkmark-round" style="color: #8DBB61"></i>
										@else
									
										@endif
									</td>
									<td class="delete-item"><a class="Delete-Item" data-id="{{ $item->id }}"><i class="ion-trash-b"></i></a></td>
								</tr>
								@endforeach 
								<tr>
									<td> Cantidad de items:</b> {{ count($reparacion->reparacionesitems )}}</td>
									<td></td>
									<td></td>
									<td></td>
									<td class="txR">TOTAL S/Iva : $ <b>{{ $total }} </b></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
							
							@endif
						</table>
					</div>

					@component('vadmin.components.loaderRow')
						@slot('text')
							Agregando...
						@endslot
					@endcomponent
					{{-- Totals --}} 
					<div class="row">
						<div class="col-md-12">
							<hr class="softhr">
							
							<div class="col-md-6">
								<div class="col-md-6">
									<div class="small-box-info"><b>Estado de la reparación:</b>
										{!! Form::text('reparacionid', $reparacion->id, ['id' => 'ReparacionId', 'class' => 'Hidden']) !!}
										{!! Form::select('estado', ['1' => 'Pendiente', '2' => 'Preparado', '3' => 'Enviado'], $reparacion->estado, ['id' => 'ReparacionStatus', 'class' => 'form-control']) !!}
									</div> 
								</div>
							</div>
							<div class="col-md-6 text-right" style="margin-top: 10px">
								<a href="{{ URL::to('vadmin/exportReparacionPdf/'.$reparacion->id) }}" target="_blank"><button type="button" class="btn btn-labeled btnRed">
								    <span class="btn-label"><i class="ion-android-download"></i></span>Generar PDF</button>
								</a>
							</div>
						</div>
					</div>
				</div>	
			</div>					
		</div> {{-- / big-card --}}
		<br>
		{{-- Product Finder --}}
		<div class="row wd-container">
			@if(count($reparacion->reparacionesitems) >= 17)
				<div class="col-md-12 horiz-container">
					No se pueden agregar más items
				</div>
			@else
			<div class="col-md-12">
				<b>Agregar producto</b>
				<hr class="softhr">
			</div>
			<div class="col-md-4">
				{!! Form::label('searchbyname', 'Nombre') !!}
				{!! Form::text('searchbyname', null, ['id' => 'PFByName', 'class' => 'form-control']) !!}
			</div>
			<div class="col-md-2">
				{!! Form::label('searchbycode','Código') !!}
				<div class="input-group">
					{!! Form::text('searchbycode', null, ['id' => 'PFByCode', 'class' => 'form-control']) !!} 
					<span id="PFByCodeBtn" class="input-group-addon button-on-input"><i class="ion-android-add-circle"></i></span>
				</div>
			</div>
			<div class="col-md-3">
				{!! Form::label('cantidad','Cantidad') !!}
				<div class="input-group">
					{!! Form::text('cantidad', null, ['id' => 'PFAmmount', 'class' => 'form-control']) !!} 
					<span id="PFAmmountBtn" class="input-group-addon button-on-input"><i class="ion-android-add-circle"></i></span>
				</div>
			</div>
			<div class="col-md-3">
				{!! Form::label('precio','Precio') !!} <br>
				{!! Form::text('precio', null, ['id' => 'RepPrice', 'class' => 'form-control']) !!}
				
			</div>
			<div class="col-md-12 horiz-container">
				<div id="DisplayProductData"></div>
			{{--
				<input id="OutProdPrice" class="Hidden" type="text">
				<input id="OutProdOffer" class="Hidden" type="text">--}}

				<input id="OutProdOfferMinAmmount" class="Hidden" type="text">
			
				<div id="PFLoader" class="Hidden"><img src="{{ asset('images/gral/loader-sm.svg') }}"/></div>
			</div>
			{{-- Store Product --}}
			<div class="col-md-3 horizontal-btn-container">
				<button id="AddItem" class="btn btnSquareHoriz buttonOk" ><i class="ion-plus-round"></i> Agregar</button>
				<div id="DisplayProductError"></div>
			</div>
			@endif
		</div>
	</>  
		
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
	@include('vadmin.components.productsjs')
	@include('vadmin.reparaciones.scripts')
@endsection

@section('custom_js')

	<script>

	/////////////////////////////////////////////////
    //                  ADD ITEM                   //
    /////////////////////////////////////////////////
	
	/*--------------------------------------------------------------*/
    /* This functionality works with productsjs.blade.php included
    /*--------------------------------------------------------------*/

	$('#AddItem').on('click',function(e){
		e.preventDefault();
        console.log()
		var erroroutput       = $('#DisplayProductError');
		
		var route             = "{{ url('vadmin/ajax_store_reparacionesitem') }}";
		var clientid          = $('#ClientData').data('clientid');
		var sectionColumnName = 'reparacion_id';
		var itemId            = $('#ClientData').data('reparacionid');
		var productCode       = $('#PFByCode').val();
		var nombre            = $('#PFByName').val();
		var cantidad          = $('#PFAmmount').val();
		var precio            = $('#RepPrice').val();
		var tipo              = $('#TipoCte').data('tipocte');

		// // Validations
		if(productCode == ''){
			erroroutput.html('Debe ingresar un código');
			erroroutput.removeClass('Hidden');
		} else if(cantidad == '') {
			erroroutput.html('Debe ingresar una cantidad');
			erroroutput.removeClass('Hidden');
		} else if(precio == '') {
			erroroutput.html('Debe ingresar un valor');
			erroroutput.removeClass('Hidden');
		} else {
        erroroutput.addClass('Hidden');

			var data = {};
			data['cliente_id']      = clientid;
			data[sectionColumnName] = itemId;
			data['producto_id']     = productCode;
			data['cantidad']        = cantidad;
			data['valor']           = precio;
			data['tipo']            = tipo;
			
			// Store Pedidos Item in Pedidos and reload page
			addItem(route, data);

		}
	});

	/////////////////////////////////////////////////
    //                  DELETE                     //
    /////////////////////////////////////////////////


	$(document).on('click', '.Delete-Item', function(e){
		e.preventDefault();
		var id    = $(this).data('id');
		var route = "{{ url('vadmin/ajax_delete_pedidositem') }}/"+id+"";
		deleteAndReload(id, route, 'Cuidado!','Desea eliminar este item de pedido?');
	});

	</script>

@endsection