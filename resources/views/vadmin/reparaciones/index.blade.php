
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Reparaciones')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listado de Reparaciones') 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/reparaciones/create') }}" class="btn btnSm buttonOther"><i class="ion-plus-round"></i> Nuevo</a>
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
	<div class="container">
		<div class="row">		
			@include('vadmin.reparaciones.searcher')
			@include('vadmin.reparaciones.list')
		</div>
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	<div id="Error"></div>
@endsection

@section('scripts')
	@include('vadmin.reparaciones.scripts')
@endsection

@section('custom_js')

	<script type="text/javascript">

	/////////////////////////////////////////////////
    //                     DELETE                  //
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

