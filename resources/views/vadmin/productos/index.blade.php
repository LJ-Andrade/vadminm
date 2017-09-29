@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Productos')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listado de Productos') 
	@section('options')
		<div class="actions">
            <a id="ToNewItem" href="{{ url('vadmin/productos/create') }}" class="btn btnSm btnWhite"><i class="ion-plus-round"></i> Nuevo Producto</a>
            <button class="OpenFilters btnSm btnWhite pull-right"><i class="ion-ios-search"></i></button>
		</div>	
	@endsection
@endsection

{{-- STYLES--}}
@section('styles')
	{{-- Include Styles Here --}}
@endsection

{{-- CONTENT --}}
@section('content')
	@component('vadmin.components.mainloader')@endcomponent

	@include('vadmin.productos.searcher')
	<div id="DolarSist" data-dolarsist="{{ $dolarsist->valor }}"></div>
    <div class="container">
		<div class="row">
			@include('vadmin.productos.list')
		</div>
		<button id="BatchDeleteBtn" class="button btnRed batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	<div id="Error"></div>	

	@component('vadmin.components.modal')
		
		@slot('id', 'PriceModal')
				
		@slot('title')
			<b>Precios del Producto</b>
		@endslot
		
		@slot('content')
			<div class="row">
				<div class="col-md-6">
					<div id="PrecioGremio"></div>
					<div id="PrecioParticular"></div>
					<div id="PrecioEspecial"></div>
					<div id="PrecioOferta"></div>
					<div id="CantOferta"></div>
				</div>
				<div class="col-md-6">
					<div><b>Costos</b></div>
					<div id="MonedaCompra"></div>
					<div id="PrecioCostoOrig"></div>
					<div id="PrecioCosto"></div>
				</div>
			</div>
		@endslot
		
		@slot('ok_button')

		@endslot
	@endcomponent
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('js/products.js') }}" ></script>
@endsection

@section('custom_js')

	<script type="text/javascript">

	/////////////////////////////////////////////////
    //                  DELETE                     //
    /////////////////////////////////////////////////
	
	// -------------- Single Delete -------------- //
	// --------------------------------------------//
	$(document).on('click', '.Delete', function(e){
		e.preventDefault();
		var id    = $(this).data('id');
		var route = "{{ url('vadmin/delete_productos') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Está seguro de borrar este producto?');
	});

	// -------------- Batch Delete --------------- //
	// --------------------------------------------//

	// ---- Batch Confirm Deletion ---- //
	$(document).on('click', '#BatchDeleteBtn', function(e) { 

		var rowsToDelete = [];  
		$(".BatchDelete:checked").each(function() {  
			rowsToDelete.push($(this).attr('data-id'));
		});

		var id = rowsToDelete;
		var route = "{{ url('vadmin/delete_productos') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Está seguro de borrar estos productos?');
	});

	/////////////////////////////////////////////////
    //            UPDATE PRODUCT STATUS            //
    /////////////////////////////////////////////////

	 $(document).on('click', '.UpdateStatusBtn', function(e) { 
            var id     = $(this).data('id');
            var route  = "{{ url('/vadmin/update_prod_status') }}/"+id+"";
            var action = $(this).data('action');
            updateProductStatus(route, action);
            
	});

	/////////////////////////////////////////////////
    //                PRICES MODAL                 //
    /////////////////////////////////////////////////

	
	$(document).on('click', '.ShowPriceBtn', function(e) { 

		var id = $(this).data('id');
		var route  = "{{ url('vadmin/get_product_full_price') }}/"+id+"";
		
		$.ajax({	
			url: route,
			method: 'POST',             
			dataType: 'JSON',
			success: function(data){
				console.log(data.preciooferta);
				var cantoferta   = 0;
				var preciooferta = 0;
				if(data.preciooferta == 0){
					preciooferta = '-';
					cantoferta   = '-';
				} else {
					preciooferta = '$ '+data.preciooferta;
					cantoferta   = data.cantoferta;
				}
				$('#PrecioGremio').html('Gremio: <b>$' + data.gremio + '</b>');
				$('#PrecioParticular').html('Particular: <b>$' + data.particular + '</b>');
				$('#PrecioEspecial').html('Especial: <b>$' + data.especial + '</b>');
				$('#PrecioOferta').html('Oferta: <b>' + preciooferta + '</b>');
				$('#CantOferta').html('Cant. Min. Oferta: <b>' + cantoferta + '</b>');
				$('#MonedaCompra').html('Moneda de compra: <b>' + data.monedacompra + '</b>');
				$('#PrecioCostoOrig').html('Costo en ' + data.monedacompra + ': <b>' + data.costo + '</b>');
				$('#PrecioCosto').html('Costo en Pesos: <b>$' + data.costopesos + '</b>');
			},
			error: function(data)
			{
				$('#Error').html(data.responseText);
			},
		});
	});
	

	</script>

@endsection

