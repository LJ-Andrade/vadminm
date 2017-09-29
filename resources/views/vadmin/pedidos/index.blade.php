
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Pedidos')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listado de Pedidos') 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/pedidos/create') }}" class="btn btnSm btnWhite"><i class="ion-plus-round"></i> Nuevo Pedido</a>
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
	@include('vadmin.pedidos.searcher')
    <div class="container">
		<div class="row">		
			@include('vadmin.pedidos.list')
		</div>
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	<div id="Error"></div>
@endsection

@section('scripts')
	@include('vadmin.pedidos.scripts')
	@include('vadmin.components.ajaxscripts');
@endsection

@section('custom_js')

	<script type="text/javascript">

	// Reset search field
	
	function resetSearch(){
		var resetName = $('#ClientAutoComplete');
		var resetId   = $('#ClientIdInput');
		resetName.val('');
		resetId.val(0);
	}
	resetSearch();

	/////////////////////////////////////////////////
    //                  DELETE                     //
    /////////////////////////////////////////////////
	
	// -------------- Single Delete -------------- //
	// --------------------------------------------//
	$(document).on('click', '.Delete', function(e){
		e.preventDefault();
		var id    = $(this).data('id');
		var route = "{{ url('vadmin/delete_pedidos') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Desea eliminar este pedido?');
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
		var route = "{{ url('vadmin/delete_pedidos') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Desea eliminar estos pedidos?');
	});


	</script>


@endsection

