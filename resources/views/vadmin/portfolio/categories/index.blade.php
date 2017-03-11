@extends('vadmin.layouts.main')

@section('header')
	@section('title', 'Vadmin | Categorías')
	@section('header_title', 'Listado de Categorías') 
	@section('options')
		<div class="actions">
			<button type="button" class="ShowNewBtn animated fadeIn btnSm buttonOther">Nueva Categoría</button>
			<button type="button" class="ShowListBtn animated fadeIn btnSm buttonOther Hidden">Listado</button>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')
	<div class="container">
		@include('vadmin.portfolio.categories.headoptions')
	</div>
    <div class="container">
		<div class="row">		
			@include('vadmin.portfolio.categories.forms')
			<div id="List"></div>
			<br>
		</div>
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	<div id="Error"></div>

	
@endsection

@include('vadmin.users.modals')

@section('scripts')
	
@endsection

{{-- CUSTOM JS SCRIPTS--}}
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
			url: '{{ url('vadmin/ajax_list_categories') }}',
			success: function(data){
				$('#List').empty().html(data);
			},
			error: function(data){
				console.log(data)
				$('#Error').html(data.responseText);
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
			success: function(data){
				$('#List').empty().html(data);
			},
			error: function(data){
				console.log(data)
			}
		});
	});

	// Search
	
	// // By Name or Email
	// $(document).on("keyup", "#SearchForm", function(e){
	// 	e.preventDefault();
	// 	var query = $('#SearchInput').val();
	// 	var role = $(this).find('option:selected').val();
		
	// 	if( query.length == 0 ){
	// 		ajax_list();
	// 	} else {
	// 		var url = "{{ url('vadmin/ajax_list_search') }}/search?query="+query+"&role="+role+"";
	// 		console.log(url);
	// 		$.ajax({
	// 			type: 'get',
	// 			url: url,
	// 			success: function(data){
	// 				$('#List').empty().html(data);
	// 			},
	// 			error: function(data){
	// 				// console.log(data)
	// 				// $('#Error').html(data.responseText);
	// 			}
	// 		});
	// 	}		
	// });

	// // By User Role

	// $('#SearchRole').change(function(){

	// 	var role = $(this).find('option:selected').val();
	// 	var query = $('#SearchInput').val();
		
	// 	if(role=='*'){
	// 		ajax_list();
	// 	} else {
	// 		var url = "{{ url('vadmin/ajax_list_search') }}/search?query="+query+"&role="+role+"";
	// 		console.log(url);
	// 			$.ajax({
	// 				type: 'get',
	// 				url: url,
	// 				success: function(data){
	// 					$('#List').empty().html(data);
	// 				},
	// 				error: function(data){
	// 					console.log(data)
	// 					$('#Error').html(data.responseText);
	// 				}
	// 		});
	// 	}
	// });
	
	/////////////////////////////////////////////////
    //                 CREATION                    //
    /////////////////////////////////////////////////

	$(document).ready(function() {
		$("#NewForm").on('submit', function(e){
			e.preventDefault();
			var form = $(this);

			form.parsley().validate();

			if (form.parsley().isValid()){
				var data  = $('#NewForm').serialize();
				var route = "{{ route('categories.store') }}";

				$.ajax({
					url: route,
					type: 'post',
					dataType: 'json',
					data: data,
					success: function(data){
						if(data.success == 'true'){
							ajax_list();
							alert_ok('Ok!','Categoría creada');
							$('.FormNewError').addClass('Hidden');
							resetForm("NewForm");
						} else if(data.success == 'false') {
							var response = data.responseJSON.name[0];
							$('.FormNewError').html(data.responseText).removeClass('Hidden');
							console.log(data);
							// alert_error('Ups!','No se ha podido crear la categoría');
						}
					},
					error: function(data){
						// $('#Error').html(data.responseText);
						var response = data.responseJSON.name[0];
						$('.FormNewError').html(response).removeClass('Hidden');
						console.log(response);
					}
				}); 
			} // End If
		});
	});


	/////////////////////////////////////////////////
    //                    EDIT                     //
    /////////////////////////////////////////////////

	// Fill Edit Form
	// Edit
	$(document).on("click", ".ShowEditBtn", function(e){
		$('#NewFormContainer').addClass('Hidden');
		var id = $(this).data('id');
		$('#EditFormContainer').removeClass('Hidden');
		var data = $('#Id'+id).data('data');
		$('#EditId').val(id);
		$('#EditName').val(data.name);	
	});


	$(document).ready(function() {
		$("#EditForm").on('submit', function(e){
			e.preventDefault();
			var form = $(this);

			form.parsley().validate();

			if (form.parsley().isValid()){
				var data  = $('#EditForm').serialize();
				var id    = $('#EditForm #EditId').val();
				
				var route = "{{ url('vadmin/ajax_update_category') }}/"+id+"";

				$.ajax({
					url: route,
					type: 'post',
					dataType: 'json',
					data: data,
					success: function(data){
						if(data.success == 'true'){
							ajax_list();
							alert_ok('Ok!','Categoría editada');
							$('.FormEditError').addClass('Hidden');
						} else if(data.success == 'false') {
							console.log(data);
							alert_error('Ups!','No se ha podido crear la categoría');
							// var response = data.responseJSON.name[0];
							
							$('.FormEditError').html(data.responseText).removeClass('Hidden');
						
						}
						$('#Error').html(data.responseText);
					},
					error: function(data){
						var response = data.responseJSON.name[0];
						$('.FormEditError').html(response).removeClass('Hidden');
						console.log(response);
					}
				}); 

			} // End If
		});
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

		var route = "{{ url('vadmin/ajax_delete_category') }}/"+id+"";

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
		confirm_batch_delete(id,'Cuidado!','Está seguro que desea eliminar los usuarios?');
		
	});

	// ---- Delete ---- //
	function batch_delete_item(id) {

		var route = "{{ url('vadmin/ajax_batch_delete_categories') }}/"+id+"";

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

	</script>

@endsection