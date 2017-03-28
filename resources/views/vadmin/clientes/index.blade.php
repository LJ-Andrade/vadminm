
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Clientes')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listado de Clientes') 
	@section('options')
		<div class="actions">
            <a id="ToNewItem" href="{{ url('vadmin/clientes/create') }}" class="btn btnSm buttonOther"><i class="ion-ios-briefcase-outline"></i> Nuevo Cliente</a>
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
	<div id="Loader" class="loader">
		<img src="{{ asset('images/loaders/loader.svg')}}" alt="">
	</div>
	@include('vadmin.clientes.searcher')
    <div class="container">
		<div class="row">
			<div id="List"></div>
			<br>
		</div>
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	<div id="Error"></div>	
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
			url: '{{ url('vadmin/ajax_list_clients') }}',
			beforeSend: function(){
				$('#Loader').show();
			},
			success: function(data){
				// $('#Loader').hide();
				$('#List').empty().html(data);
			},
			complete(){
				$('#Loader').hide();
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
		// var page_num = href.split('=').pop();
		// var url      = "{{ url('vadmin/users/ajax_list_user') }}?page="+page_num+"";

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
			var url = "{{ url('vadmin/ajax_list_search_clientes') }}/search?id="+id+"&name="+name+"";
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
					// console.log(data)
					$('#Error').html(data.responseText);
				}
			});
		// }		
	});


	/////////////////////////////////////////////////
    //                     DELETE                  //
    /////////////////////////////////////////////////


	// -------------- Single Delete -------------- //
	// --------------------------------------------//
	$(document).on('click', '.Delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		confirm_delete(id, 'Cuidado!','Está seguro?');
	});

	function delete_item(id, route) {	

		var route = "{{ url('vadmin/ajax_delete_cliente') }}/"+id+"";

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

		var route = "{{ url('vadmin/ajax_batch_delete_clientes') }}/"+id+"";

		$.ajax({
			url: route,
			method: 'post',             
			dataType: "json",
			data: {id: id},
			success: function(data){
				for(i=0; i < id.length ; i++){
					$('#Id'+id[i]).hide(200);
				}
				$('#BatchDeleteBtn').addClass('Hidden');
				ajax_list();
				// $('#Error').html(data.responseText);
				// console.log(data);
			},
			error: function(data)
			{
				console.log(data);
				$('#Error').html(data.responseText);
			},
		});

	}



	//// 

	

	</script>

@endsection

