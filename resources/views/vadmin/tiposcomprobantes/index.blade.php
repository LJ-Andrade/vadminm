@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Tipos Comprobante')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listado de tipos de comprobante') 
	@section('options')
		<div class="actions">
            <a id="ToNewItem" href="{{ url('vadmin/tiposcomprobantes/create') }}" class="btn btnSm buttonOther"><i class="ion-plus-round"></i> Nuevo Tipo de Comprobante</a>
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
			@include('vadmin.tiposcomprobantes.searcher')
            @component('vadmin.components.tablelist')
				@slot('tableTitles')
					<th></th>
					<th>Nombre</th>
					<th>Código de Afip</th>
					<th>Letra</th>
					<th></th>
				@endslot
				@slot('tableContent')
					@foreach($tiposcomprobantes as $item)
						<tr id="Id{{ $item->id }}" class="TableList-Row table-list-row">
							<td class="list-checkbox">
								<input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
							</td>
							<td>{{ $item->name }}</td>
							<td>{{ $item->afipcode }}</td>
							<td>{{ $item->letter }}</td>
							<td class="list-actions">
								<div class="TableList-Actions inner Hidden">
									<a href="{{ url('/vadmin/tiposcomprobantes/' . $item->id . '/edit') }}" class="btn action-btn btnGreen" data-id="{{ $item->id }}">
										<i class="ion-edit"></i>
									</a>
									{{-- <a target="_blank" class="btn action-btn btnBlue">
										<i class="ion-ios-search"></i>
									</a> --}}
									<a class="Delete btn action-btn btnRed" data-id="{!! $item->id !!}">
										<i class="ion-ios-trash-outline"></i>
									</a>
									<a class="Close-Actions-Btn btn btn-close btnGrey">
										<i class="ion-ios-close-empty"></i>
									</a>
								</div>
							</td>
						</tr>
					@endforeach
				@endslot
				@slot('tableEmpty')
					@if(! count($tiposcomprobantes))
					<tr>
						<td>No se han encontrado registros</td>
					</tr>
					@endif
				@endslot
				@slot('pagination')
					{!! $tiposcomprobantes->render(); !!}
				@endslot
			@endcomponent
			<div class="warning">			
				<i class="ion-alert-circled"></i> <b>Atención:</b> Los datos de esta sección son vitales para el funcionamiento del webservice de la Afip. Solo haga cambios si está seguro de los mismos.
			</div>
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
    //                  DELETE                     //
    /////////////////////////////////////////////////
	
	// -------------- Single Delete -------------- //
	// --------------------------------------------//
	$(document).on('click', '.Delete', function(e){
		e.preventDefault();
		var id    = $(this).data('id');
		var route = "{{ url('vadmin/delete_tiposcomprobantes') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Desea eliminar este tipo de comprobante?');
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
		var route = "{{ url('vadmin/delete_tiposcomprobantes') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Desea eliminar estos tipos de comprobantes?');
	});
	</script>

@endsection


