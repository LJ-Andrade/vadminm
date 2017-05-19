
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Pedidos')

{{-- HEAD--}}
@section('header')
	@section('header_title')
		Hoja de Pedido
    @endsection 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/pedidos') }}" class="btn btnSm buttonOther">Volver</a>
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
        <div id="Error"></div>
		<div class="row big-card">
		 	<div class="title">
			    <h2>Cliente: {{ $pedido->cliente->razonsocial}}</h2>
				<div id="ClientData" data-pedidoid="{{ $pedido->id }}" data-clientid="{{ $pedido->cliente->id }}"></div>
				<div id="TipoCte" class="small-text" data-tipocte="{{ $pedido->cliente->tipo_id }}">{{ $tipocte }}</div>
				<div class="small-text">Pedido N°: {{ $pedido->id }} </div>
				<div class="right text-right">Creado el <br> {{ transDateT($pedido->created_at) }}</div>
            </div>		
			<div class="content">
				<div class="row">
					<div class="col-md-12 subtitle">
						<div class="col-md-3 col-sm-3">Item</div>
						<div class="col-md-3 col-sm-3">Cantidad</div>
						<div class="col-md-3 col-sm-3">Precio U.</div>
						<div class="col-md-3 col-sm-3">Total</div>
					</div>
					@if ($pedido->pedidositems->isEmpty() )
					<div class="col-md-12">
						No hay items ingresados
					</div>
					@else
					@foreach($pedido->pedidositems as $item) 
					<div id="Id{{ $item->id }}" data-test="hola" class="Item-Row col-md-12 item-row">
						<div class="col-md-3 col-sm-3"><span>{{ $item->producto->nombre }}</span></div> 
						<div class="col-md-3 col-sm-3"><span>{{ $item->cantidad }}</span>	</div>
						<div class="col-md-3 col-sm-3"><span>$ {{ $item->valor}}</span>	</div>
						<div class="col-md-3 col-sm-3"><span>$ {{ $item->cantidad * $item->valor}}</span></div>
						<div class="delete-item"><a class="Delete-Item" data-id="{{ $item->id }}"><i class="ion-ios-minus"></i></a></div>
					</div>
					@endforeach
					@endif
					{{-- Totals --}} 
					<div class="row">
						<div class="col-md-12">
							<hr class="softhr">
							{{--<div class="col-md-2">
								{!! Form::select('estado', ['Pendiente', 'Preparado', 'Enviado'], null, ['id' => 'ClienteBySelect', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Estado del pedido']) !!}
							</div> --}}
							<div class="col-md-3 pull-right">
								TOTAL: <b>$ {{ $total }}</b>
							</div>
						</div>
					</div>

					{{-- Product Finder --}}
					<div class="col-md-12">
						<hr class="softhr">
						<div class="col-md-3">
							{!! Form::label('searchbycode','Código de Producto') !!}
							{!! Form::text('searchbycode', null, ['id' => 'cfCodigoInput', 'class' => 'form-control']) !!} 
						</div>
						<div class="col-md-3">
							{!! Form::label('searchbyname', 'Nombre') !!}
							{!! Form::text('searchbyname', null, ['id' => 'cfNombreInput', 'class' => 'form-control']) !!} 
							<input class="typeahead form-control" style="margin:0px auto;width:300px;" type="text">
						</div>
						<div class="col-md-3">
							{!! Form::label('cantidad','Cantidad') !!}
							{!! Form::text('cantidad', null, ['id' => 'cfCantidadInput', 'class' => 'form-control']) !!} 
						</div>
						<div class="col-md-3">
							{!! Form::label('precio','Precio') !!}
							{!! Form::text('precio', null, ['id' => 'cfPrecioInput', 'class' => 'form-control']) !!} 
						</div>
						{{-- Display Product Name --}}
						<div class="col-md-12 horiz-container">
							<div id="CfOutputPreview" class="inner Hidden"></div>
							<div id="DisplayErrorOutPut" class="inner Hidden"></div>
						</div>
						{{-- Store Product --}}
						<div class="col-md-3 horizontal-btn-container">
							<button id="AddItem" class="btn btnSquareHoriz buttonOk" ><i class="ion-plus-round"></i> Agregar</button>
						</div>
					</div>
					<br>

						{{-- Advanced Search Product --}}
					{{-- 	<div class="col-md-12">
							<button class="btn button buttonOther" data-toggle="modal" data-target="#NewItemModal" ><i class="ion-ios-search"></i> Buscar Producto</button>
						</div> --}}
					
					
				
				</div>	
			</div>		
			<div class="right-bottom">
				<button class="btn button buttonOk"><i class="ion-share"></i> Facturar</button>
				<button class="btn button buttonOther"><i class="ion-paper-airplane"></i> Enviar</button>
				<button class="btn button grey-back"><i class="ion-ios-printer"></i> Imprimir</button>
			</div>
		</div>
	</div>  


	{{-- Product Advanced Searcher Modal --}}
	@component('vadmin.components.modal')
		
		@slot('id', 'NewItemModal')
				
		@slot('title', 'Seleccion de Producto')
		
		@slot('content')
			<div class="row">
				<div class="col-md-12">
				
					{!! Form::open(['method' => 'POST', 'id' => 'UpdateStockForm']) !!}	
						<div class="col-md-6">
							{!! Form::label('familia_id', 'Familia') !!}
							{!! Form::select('familia_id', $familias, null, ['id' => 'FamiliasSelect', 'class' => 'form-control', 'placeholder' => 'Seleccione una familia', 'required' => '']) !!}
							{!! Form::label('producto', 'Producto') !!}
							<select name="producto" id="ProductOnlySelect" class="form-control" required="" placeholder="Seleccione una subfamilia">
							</select>
						</div>
						<div class="col-md-6">
							{!! Form::label('familia_id', 'Subfamilia') !!}
							<select name="subfamilia_id" id="SubfamiliasSelect" class="form-control" required="" placeholder="Seleccione una subfamilia">
							</select>
						</div>
						<div class="col-md-12">
							<div id="Product-Only-Output">
							
							</div>
						</div>
					{!! Form::close() !!}
				
				</div>
			</div>
		@endslot
		
		@slot('ok_button')
			<button id="ModalProductSelectBtn" class="btn button buttonOk"><i class="ion-checkmark-round"></i> Seleccionar</button>
		@endslot
	@endcomponent


		
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	{{-- <script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script> --}}
	<script type="text/javascript" src="{{ asset('plugins/typeahead-autocomplete/typeahead.jquery.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
	@include('vadmin.components.ajaxscripts');
@endsection

@section('custom_js')

	<script>

		// Select Product With Code
		// $("#CodigoInput").on( "keydown", function(e) {
		// 	var id      = $(this).val();
		// 	if(e.which == 13) {
		// 		search_product(id);
		// 	}
		// });
		


		$('#AddItem').on('click',function(e){

			var codigo   = $('#cfCodigoInput').val();
			var nombre   = $('#cfNombreInput').val();
			var cantidad = $('#cfCantidadInput').val();
			var precio   = $('#cfPrecioInput').val();
			var preview  = $('#CfOutputPreview');

			
			preview.removeClass('Hidden');
			preview.html(codigo+', '+nombre);

		});


		// Select Product With Modal
		// $('#ModalProductSelectBtn').on('click',function(e){
			
		// 	var id = $("#ProductOnlySelect option:selected").val();
		// 	search_product(id);
		// 	var codigo   = $('#CodigoInput').val(id);
		// 	$('#NewItemModal').modal('toggle');

		// });

		// $('#AddItem').click(function(){
			
		// 	var clientid    = $('#ClientData').data('clientid');
		// 	var pedidoid    = $('#ClientData').data('pedidoid');
		// 	var codigo      = $('#CodigoInput').val();
		// 	var cantidad    = $('#CantidadInput').val();
		// 	var precio      = $('#PrecioInput').val();
		// 	var tipo        = $('#TipoInput').data('tipocte');
		// 	var route       = "{{ url('vadmin/ajax_store_pedidoitem') }}";
		// 	var erroroutput = $('#DisplayErrorOutPut');
		// 	var proceed     = $('#DisplayOutPut').data('proceed');
		// 	// console.log('Id de Cliente: ' + clientid + ' - Id de Pedido: ' + pedidoid + ' - Código: ' + codigo + ' - Cantidad: ' + cantidad + ' - Tipo de Cliente: ' + tipo);

		// 	if(codigo==''){
		// 		erroroutput.html('Debe ingresar un código');
		// 		erroroutput.removeClass('Hidden');
		// 	} else if(cantidad=='') {
		// 		erroroutput.html('Debe ingresar una cantidad');
		// 		erroroutput.removeClass('Hidden');
		// 	} else if(precio=='') {
		// 		erroroutput.html('Debe ingresar un valor');
		// 		erroroutput.removeClass('Hidden');

		// 	} else {

		// 		$.ajax({
		// 			url: route,
		// 			method: 'post',             
		// 			dataType: "json",
		// 			data: {cliente_id: clientid, pedido_id: pedidoid, producto_id: codigo, cantidad: cantidad, valor: precio},
		// 			success: function(data){
		// 				location.reload();
		// 				// console.log(data);	
		// 			},
		// 			error: function(data)
		// 			{
		// 				erroroutput.html('El producto no existe');
		// 				erroroutput.removeClass('Hidden');
		// 			},
		// 		});
		// 	}
		// });



	/////////////////////////////////////////////////
    //                  DELETE                     //
    /////////////////////////////////////////////////

	// -------------- Single Delete -------------- //
	// --------------------------------------------//
	$(document).on('click', '.Delete-Item', function(e){
		e.preventDefault();
		var id   = $(this).data('id');
		confirm_delete(id, 'Cuidado!','Desea eliminar este item?');
	});

	function delete_item(id, route) {	
		var route = "{{ url('vadmin/ajax_delete_pedidositem') }}/"+id+"";

		$.ajax({
			url: route,
			method: 'post',             
			dataType: "json",
			data: {id: id},
			success: function(data){
				console.log(data.result);
				if (data.result == 1) {
					$('#Id'+id).hide(200);
					alert_ok('Ok!','Eliminación completa');
				} else {
					alert_error('Ups!','Ha ocurrido un error');
				}
			},
			error: function(data)
			{
				$('#Error').html(data.responseText);
				console.log(data);	
			},
		});
	}

	</script>

@endsection