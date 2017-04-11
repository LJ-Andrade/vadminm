
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
    <div class="container">
		<div class="row">
			<div id="List"></div>

			<br>
		</div>
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	<div id="Error"></div>	

	@component('vadmin.components.modal')
		
		@slot('id', 'PriceModal')
		
		
		@slot('title', 'Precios del Producto')
		

		@slot('content')
			<div class="row">
				<div class="col-md-12">
					Dolar del sistema: <b>{{ $dolarsist->valor }} </b><br>
				</div>
				<div class="col-md-6">
					<div id="PrecioCosto"></div>
					<div id="PrecioGremio"></div>
				</div>
				<div class="col-md-6">
					<div id="PrecioParticular"></div>
					<div id="PrecioOferta"></div>
				</div>
				<div class="col-md-6">
					<div id="PrecioEspecial"></div>
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
    //                 LIST                        // 
    /////////////////////////////////////////////////


	$(document).ready(function(){
		ajax_list();
	});

	var ajax_list = function(){

		$.ajax({
			type: 'get',
			url: '{{ url('vadmin/ajax_list_productos') }}',
			beforeSend: function(){
				// $('#Loader').show();
			},
			success: function(data){
				// $('#Loader').hide();
				$('#List').empty().html(data);
			},
			complete(){
				// $('#Loader').hide();
			},
			error: function(data){
				console.log(data)
				// $('#Loader').hide();
				//$('#Error').html(data.responseText);
			}
		});
	}

	// Pagination
	$(document).on("click", ".pagination li a", function(e){
		e.preventDefault();

		var url     = $(this).attr('href');

		$.ajax({
			type: 'get',
			url: url,
			beforeSend: function(){
				$('#Loader').show();
			},
			success: function(data){
				$('#List').empty().html(data);
			},
			complete: function(){
				$('#Loader').hide();
			},
			error: function(data){
				console.log(data)
			}
		});
	});


	// By Name or Email
	$(document).on("keyup", "#SearchForm", function(e){
		e.preventDefault();
		var name  = $('#SearchByName').val();
		var id    = $('#SearchById').val();

		// if( name.length == 0 ){
		// 	ajax_list();
		// } else {
			var url = "{{ url('vadmin/ajax_list_search_productos') }}/search?id="+id+"&name="+name+"";
			// var url = "{{ url('vadmin/ajax_list_search_clients') }}/search?name="+name+"";
			console.log(url);
			$.ajax({
				type: 'get',
				url: url,
				complete: function(data){
					// $('#Error').html(data.responseText);		
				},
				success: function(data){
					$('#List').empty().html(data);
				},
				error: function(data){
					console.log(data)
					$('#Error').html(data.responseText);
				}
			});
		// }		
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
				// for(i=0; i < id.length ; i++){
				// 	$('#Id'+id[i]).hide(200);
				// }
				$('#BatchDeleteBtn').addClass('Hidden');
				ajax_list();
				
				// $('#Error').html(data.responseText);
				// console.log(data);
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
	//// 

	/////////////////////////////////////////////////
    //                PRICES MODAL                 //
    /////////////////////////////////////////////////

	$(document).ready(function(){
	
	
		$(document).on('click', '.ShowPriceBtn', function(e) { 
			var precioCosto      = $(this).data('costo');
			var precioGremio     = $(this).data('gremio');
			var precioParticular = $(this).data('particular');
			var precioOferta     = $(this).data('oferta');
			var precioEspecial   = $(this).data('especial');

			console.log(precioCosto);

			$('#PrecioCosto').html('Precio de costo: <b>$ ' + precioCosto + '</b>');
			$('#PrecioGremio').html('Precio al gremio: <b>$ ' + precioGremio + '</b>');
			$('#PrecioParticular').html('Precio a particular: <b>$ ' + precioParticular + '</b>');
			$('#PrecioOferta').html('Precio de oferta: <b>$ ' + precioOferta + '</b>');
			$('#PrecioEspecial').html('Precio especial: <b>$ ' + precioEspecial + '</b>');
		});
		
	});
	</script>

@endsection

