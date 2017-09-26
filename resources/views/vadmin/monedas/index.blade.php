
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Monedas')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listado de Monedas') 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/monedas/create') }}" class="btn btnSm buttonOther">Nueva</a>
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
			@include('vadmin.monedas.searcher')
            @component('vadmin.components.tablelist')
				@slot('tableTitles')
					<th></th>
					<th>Moneda</th>
					<th>Valor</th>
					<th></th>
					<th></th>
				@endslot
				@slot('tableContent')
					@foreach($monedas as $item)
						<tr id="Id{{ $item->id }}" class="TableList-Row table-list-row">
							<td class="list-checkbox">
								<input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
							</td>
							<td>{{ $item->nombre }}</td>
							<td>$ {{ $item->valor }}</td>
							<td></td>
							<td class="list-actions">
								<div class="TableList-Actions inner Hidden">
									<a href="{{ url('/vadmin/monedas/' . $item->id . '/edit') }}" class="btn action-btn btnGreen" data-id="{{ $item->id }}">
										<i class="ion-edit"></i>
									</a>
									{{-- <a target="_blank" class="btn action-btn btnBlue">
										<i class="ion-ios-search"></i>
									</a> --}}
                                    @if($item->id == 1 || $item->id == 2 || $item->id == 3)
                                    @else
									<a class="Delete btn action-btn btnRed" data-id="{!! $item->id !!}">
										<i class="ion-ios-trash-outline"></i>
									</a>
                                    @endif
									<a class="Close-Actions-Btn btn btn-close btnGrey">
										<i class="ion-ios-close-empty"></i>
									</a>
								</div>
							</td>
						</tr>
					@endforeach
				@endslot
				@slot('tableEmpty')
					@if(! count($monedas))
					<tr>
						<td>No se han encontrado registros</td>
					</tr>
					@endif
				@endslot
				@slot('pagination')
					{!! $monedas->render(); !!}
				@endslot
			@endcomponent

	    <div id="Error"></div>
        </div>
    </div>
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
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
		var route = "{{ url('vadmin/delete_monedas') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Está seguro de borrar esta moneda?');
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
		var route = "{{ url('vadmin/delete_localidades') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Está seguro de borrar estas monedas?');
	});

	</script>

@endsection

