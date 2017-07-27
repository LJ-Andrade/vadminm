@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Provincias')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listado de Provincias') 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/provincias/create') }}" class="btn btnSm buttonOther"><i class="ion-plus-round"></i> Nueva Provincia</a>
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
			@include('vadmin.provincias.searcher')
			<div class="table-responsive table-list">          
				<table class="table table-striped">
					<thead>
					<tr>
						<th></th>
						<th>Provincias</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					@foreach($provincias as $item)
						<tr id="Id{{ $item->id }}" class="TableList-Row table-list-row">
							<td class="list-checkbox">
								<input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
							</td>
							<td>{{ $item->name }}</td>
							<td></td>
							<td></td>
							<td class="list-actions">
								<div class="TableList-Actions inner Hidden">
									<a href="{{ url('/vadmin/provincias/' . $item->id . '/edit') }}" class="btn action-btn btnGreen" data-id="{{ $item->id }}">
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
					@if(! count($provincias))
					<tr>
						<td>No se han encontrado registros</td>
					</tr>
					@endif
					</tbody>
				</table>
				{!! $provincias->render(); !!}
			</div>
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
		var route = "{{ url('vadmin/delete_provincias') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Está seguro que desea eliminar esta provincia?');
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
		var route = "{{ url('vadmin/delete_provincias') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Está seguro que desea eliminar estas provincias?');
	});
	</script>

@endsection

