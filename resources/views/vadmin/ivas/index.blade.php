
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Iva')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Categorías Impositivas') 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/ivas/create') }}" class="btn btnSm buttonOther">Nueva Categoría</a>
            <button class="OpenFilters btnSm buttonOther pull-right"><i class="ion-ios-search"></i></button>
		</div>	
	@endsection
@endsection

{{-- CONTENT --}}
@section('content')
    <div class="container">
		<div class="row">		
			@include('vadmin.ivas.searcher')

			@component('vadmin.components.tablelist')
				@slot('tableTitles')
					<th></th>
					<th>Detalle</th>
					<th>Tipo Fc</th>
					<th>Código de Afip</th>
					<th></th>
				@endslot
				@slot('tableContent')
					@foreach($ivas as $item)
						<tr id="Id{{ $item->id }}" class="TableList-Row table-list-row">
							<td class="list-checkbox">
								<input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
							</td>
							<td>{{ $item->name }}</td>
							<td>{{ $item->tipofc }}</td>
							<td>{{ $item->afipcode }}</td>
							<td class="list-actions">
								<div class="TableList-Actions inner Hidden">
									<a href="{{ url('/vadmin/ivas/' . $item->id . '/edit') }}" class="btn action-btn btnGreen" data-id="{{ $item->id }}">
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
					@if(! count($ivas))
					<tr>
						<td>No se han encontrado registros</td>
					</tr>
					@endif
				@endslot
				@slot('pagination')
					{!! $ivas->render(); !!}
				@endslot
			@endcomponent
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
		var route = "{{ url('vadmin/delete_ivas') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Si borra este registro pueden generar problemas con la facturación. Está seguro de proceder?');
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
		var route = "{{ url('vadmin/delete_ivas') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Si borra estos registros se pueden generar problemas con la facturación. Está seguro de proceder?');
	});

	</script>

@endsection

