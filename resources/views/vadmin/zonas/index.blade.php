
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Zonas')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listado de Zonas') 
	@section('options')
		<div class="actions">
            <a id="ToNewItem" href="{{ url('vadmin/zonas/create') }}" class="btn btnSm buttonOther"><i class="ion-plus-round"></i> Nueva Zona</a>
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
			@include('vadmin.zonas.searcher')
            @component('vadmin.components.tablelist')
				@slot('tableTitles')
					<th></th>
					<th>Zona</th>
					<th></th>
					<th></th>
					<th></th>
				@endslot
				@slot('tableContent')
					@foreach($zonas as $item)
						<tr id="Id{{ $item->id }}" class="TableList-Row table-list-row">
							<td class="list-checkbox">
								<input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
							</td>
							<td>{{ $item->name }}</td>
							<td></td>
							<td></td>
							<td class="list-actions">
								<div class="TableList-Actions inner Hidden">
									<a href="{{ url('/vadmin/zonas/' . $item->id . '/edit') }}" class="btn action-btn btnGreen" data-id="{{ $item->id }}">
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
					@if(! count($zonas))
					<tr>
						<td>No se han encontrado registros</td>
					</tr>
					@endif
				@endslot
				@slot('pagination')
					{!! $zonas->render(); !!}
				@endslot
			@endcomponent

		</div>
		{{-- Export Button --}}
		<div class="col-md-3">
			<div class="form-group">
				<a id="ExportExcelBtn" href="{{ URL::to('vadmin/exportExcel/Zona/listado-zonas') }}"><button  class="btnSmall green-back"><i class="ion-android-exit"></i> Exportar a Excel</button></a>
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
		var route = "{{ url('vadmin/delete_zonas') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Desea eliminar esta zona?');
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
		var route = "{{ url('vadmin/delete_zonas') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Desea eliminar estas zonas?');
	});
	</script>

@endsection

