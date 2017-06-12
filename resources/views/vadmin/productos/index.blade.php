@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Productos')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listado de Productos') 
	@section('options')
		<div class="actions">
            <a id="ToNewItem" href="{{ url('vadmin/productos/create') }}" class="btn btnSm buttonOther"><i class="ion-ios-briefcase-outline"></i> Nuevo Producto</a>
            <button class="OpenFilters btnSm buttonOther pull-right"><i class="ion-ios-search"></i></button>
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
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	<div id="Error"></div>	

	@component('vadmin.components.modal')
		
		@slot('id', 'PriceModal')
				
		@slot('title', 'Precios del Producto')
		
		@slot('content')
			<div class="row">
				<div class="col-md-6">
					<div><b>Dólares</b></div>
					<div id="PrecioCosto"></div>
					<div id="PrecioGremio"></div>
					<div id="PrecioParticular"></div>
					<div id="PrecioEspecial"></div>
					<div id="PrecioOferta"></div>
					<div class="CantOferta"></div>
				</div>
				<div class="col-md-6">
					<div><b>Pesos</b></div>
					<div id="PrecioCostoPesos"></div>
					<div id="PrecioGremioPesos"></div>
					<div id="PrecioParticularPesos"></div>
					<div id="PrecioEspecialPesos"></div>
					<div id="PrecioOfertaPesos"></div>
				</div>
			</div>
		@endslot
		
		@slot('ok_button')

		@endslot
	@endcomponent
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
@endsection

@section('custom_js')

	<script type="text/javascript">

	/////////////////////////////////////////////////
    //                UPADTE STATUS                //
    /////////////////////////////////////////////////

	$(document).on('click', '.UpdateStatusBtn', function(e) { 

		var id           = $(this).data('id');
		var route        = "{{ url('/vadmin/update_prod_status') }}/"+id+"";
		var statusBtn    = $('#UpdateStatusBtn'+id);
		var switchstatus = statusBtn.data('switchstatus');
		var statusBtn    = $(this).children();	

		$.ajax({
			
			url: route,
			method: 'post',             
			dataType: 'json',
			data: { id: id, estado: switchstatus
			},
			success: function(data){
				var updatedStatus = (data.lastStatus);
				var iconStatus    = '';
				location.reload();
			},
			complete: function(data){
				toggleLoader();
			},
			error: function(data)
			{
				$('#Error').html(data.responseText);
				
			},
		});
	});
	
	/////////////////////////////////////////////////
    //                  DELETE                     //
    /////////////////////////////////////////////////


	// -------------- Single Delete -------------- //
	// --------------------------------------------//
	$(document).on('click', '.Delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		confirm_delete(id, 'Cuidado!','Está seguro?');
	});

	function delete_item(id, route) {	

		var route = "{{ url('vadmin/ajax_delete_producto') }}/"+id+"";

		$.ajax({
			url: route,
			method: 'post',             
			dataType: "json",
			data: {id: id},
			success: function(data){
				console.log(data);
				if (data == 1) {
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

	// -------------- Batch Deletex -------------- //
	// --------------------------------------------//

	// ---- Batch Confirm Deletion ---- //
	$(document).on('click', '#BatchDeleteBtn', function(e) { 

		var rowsToDelete = [];  
		$(".BatchDelete:checked").each(function() {  
			rowsToDelete.push($(this).attr('data-id'));
		});

		var id = rowsToDelete;
		confirm_batch_delete(id,'Cuidado!','Está seguro que desea eliminar?');
		
	});

	// ---- Delete ---- //
	function batch_delete_item(id) {

		var route = "{{ url('vadmin/ajax_batch_delete_productos') }}/"+id+"";

		$.ajax({
			url: route,
			method: 'post',             
			dataType: "json",
			data: {id: id},
			success: function(data){
				$('#BatchDeleteBtn').addClass('Hidden');
				location.reload();
				console.log(data);
			},
			complete: function(){
				toggleLoader();
			},
			error: function(data)
			{
				console.log(data);
				$('#Error').html(data.responseText);
			},
		});
	}


	/////////////////////////////////////////////////
    //                PRICES MODAL                 //
    /////////////////////////////////////////////////

	$(document).ready(function(){
		
		$(document).on('click', '.ShowPriceBtn', function(e) { 
			var precioCosto   = $(this).data('costo');
			var pjeGremio     = $(this).data('gremio');
			var pjeParticular = $(this).data('particular');
			var pjeEspecial   = $(this).data('especial');
			var precioOferta  = $(this).data('oferta');
			var cantOferta    = $(this).data('cantoferta');
			var dolarSist     = $('#DolarSist').data('dolarsist');
			console.log(dolarSist);
			$('#PrecioCosto').html('Precio de costo: <b>u$s ' + precioCosto + '</b>');
			$('#PrecioGremio').html('Precio al gremio: <b>u$s ' + calcPtje(precioCosto, pjeGremio) + '</b>');
			$('#PrecioParticular').html('Precio a particular: <b>u$s ' + calcPtje(precioCosto, pjeParticular) + '</b>');
			$('#PrecioEspecial').html('Precio especial: <b>u$s ' + calcPtje(precioCosto, pjeEspecial) + '</b>');
			$('#PrecioOferta').html('Precio de oferta: <b>u$s ' + precioOferta + '</b>');
			$('.CantOferta').html('Cantidad: ' + cantOferta );

			$('#PrecioCostoPesos').html('Precio de costo: <b>$ ' + formatNum(precioCosto*dolarSist, 2) + '</b>');
			$('#PrecioGremioPesos').html('Precio al gremio: <b>$ ' + formatNum(calcPtje(precioCosto, pjeGremio)*dolarSist, 2) + '</b>');
			$('#PrecioParticularPesos').html('Precio a particular: <b>$ ' + formatNum(calcPtje(precioCosto, pjeParticular)*dolarSist, 2) + '</b>');
			$('#PrecioEspecialPesos').html('Precio especial: <b>$ ' + formatNum(calcPtje(precioCosto, pjeEspecial)*dolarSist, 2) + '</b>');
			$('#PrecioOfertaPesos').html('Precio de oferta: <b>$ ' + formatNum(precioOferta*dolarSist, 2) + '</b>');
			console.log(formatNum(calcPtje(precioCosto, pjeGremio)*dolarSist,2));
		});
		
	});
	</script>

@endsection

