
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
	@component('vadmin.components.mainloader')@endcomponent

	@include('vadmin.clientes.searcher')
    <div class="container">
		<div class="row">
			<div id="Error"></div>	
			<div class="row">
				@include('vadmin.clientes.list')
			</div>
			<br>
		</div>
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
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
		var route = "{{ url('vadmin/delete_clients') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Desea borrar este cliente?');
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
		var route = "{{ url('vadmin/delete_clients') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Desea borrar estos clientes?');
	});


	</script>

@endsection

