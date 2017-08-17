@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Comprobantes')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listado de Comprobantes') 
	@section('options')
		<div class="actions">
            <a id="ToNewItem" href="{{ url('vadmin/comprobantes/create') }}" class="btn btnSm buttonOther"><i class="ion-plus-round"></i> Nuevo Comprobante</a>
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
			@include('vadmin.comprobantes.searcher')
            @component('vadmin.components.tablelist')
				@slot('tableTitles')
					<th></th>
					<th>Documento</th>
					<th>Número</th>
					<th>Cae</th>
					<th>Vto</th>
					<th>Cliente</th>
					<th></th>
				@endslot
				@slot('tableContent')
					@foreach($comprobantes as $item)
						<tr id="Id{{ $item->id }}" class="TableList-Row table-list-row">
							<td class="list-checkbox">
								<input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
							</td>
							<td>
								{{ compType($item->modo) }}
								{{ $item->letra }}
							</td>
							<td>{{ $item->nro }}</td>
							<td>{{ $item->cae}}</td>
							<td>{{ $item->vto}}</td>
							<td>{{ $item->cliente->razonsocial }}</td>
							<td class="list-actions">
								<div class="TableList-Actions inner Hidden">
									{{--<a href="{{ url('/vadmin/comprobantes/' . $item->id . '/edit') }}" class="btn action-btn btnGreen" data-id="{{ $item->id }}">
										<i class="ion-edit"></i>
									</a>
									<a target="_blank" class="btn action-btn btnBlue">
										<i class="ion-ios-search"></i>
									</a>
									--}} 
									 <a href="{{ URL::to('Feafip/facturas/' . $item->doc_filename . '.pdf') }}" target="_blank">
										<img class="small-list-img" src="{{ asset('images/gral/pdfsmall.png') }}">
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
					@if(! count($comprobantes))
					<tr>
						<td>No se han encontrado registros</td>
					</tr>
					@endif
				@endslot
				@slot('pagination')
					{!! $comprobantes->render(); !!}
				@endslot
			@endcomponent

		</div>
		{{-- Export Button 
		<div class="col-md-3">
			<div class="form-group">
				<a id="ExportExcelBtn" href="{{ URL::to('vadmin/exportExcel/Comprobante/listado-comprobantes') }}"><button  class="btnSmall green-back"><i class="ion-android-exit"></i> Exportar a Excel</button></a>
			</div>
		</div>
		--}}
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
		var route = "{{ url('vadmin/delete_comprobantes') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Desea eliminar esta comprobantes?');
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
		var route = "{{ url('vadmin/delete_comprobantes') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Desea eliminar estas comprobantes?');
	});
	</script>

@endsection


