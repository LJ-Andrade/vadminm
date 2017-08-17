
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Reparaciones')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listado de Reparaciones') 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/reparaciones/create') }}" class="btn btnSm buttonOther">Nueva Reparación</a>
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
		Trabajando en esta sección
			@include('vadmin.reparaciones.searcher')
            <div class="col-md-12 animated fadeIn main-list">
                @foreach($reparaciones as $item)
                <div id="Id{{ $item->id }}" class="Item-Row Select-Row-Trigger row item-row simple-list">
                    {{-- Column / Image --}}
                    <div class=""></div>

                    <div class="content">
                        {{-- Column --}}
                        <div class="col-xs-6 col-sm-1 col-md-1 inner">
                        	<span><b>N°: {{ $item->id }}  </b></span>
                        </div>
                        {{-- Column --}}
                        <div class="col-xs-6 col-sm-4 col-md-4 inner-tags">
							Cliente: {{ $item->cliente->razonsocial }}
                        </div>      
						<div class="col-xs-6 col-sm-3 col-md-3">
							<?php
								switch($item->estado)
								{
									case '1':
										echo "<span class='custom-badge red-back'>Pendiente</span>";
										break;
									case '2':
										echo "<span class='custom-badge blue-back'>En reparación</span>";
										break;
									case '3':
										echo "<span class='custom-badge green-back'>Reparado</span>";
										break;
									case '4':
										echo "<span class='custom-badge green-back'>Entregado</span>";
										break;
									default:
										echo "<span class='custom-badge blue-back'>Sin Estado</span>";
								}
							?>

                        </div>
						<div class="col-xs-6 col-sm-3 col-md-3 pull-right">
							{{ transDateT($item->created_at) }} 
							@if(is_null( $item->user))  
							@else <span class="small"> ( {!! $item->user->name !!} ) </span>
							@endif  
                        </div>                        

                    </div>
                    {{-- Batch Delete --}} 
					<div class="batch-delete-checkbox">
						<input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
					</div>
                    {{-- Hidden Action Buttons --}}
                    <div class="List-Actions lists-actions Hidden">
					{{-- 	<a href="{{ url('/vadmin/pedidos/' . $item->id . '/edit') }}" class="btnSmall buttonOk" data-id="{{ $item->id }}">
							<i class="ion-ios-compose-outline"></i>
						</a> --}}
						<a href="{{ url('vadmin/reparaciones/'. $item->id) }}" class="btnSmall buttonOther">
							<i class="ion-ios-search"></i>
						</a>
						<button class="Delete btnSmall buttonCancel" data-id="{!! $item->id !!}">
							<i class="ion-ios-trash-outline"></i>
						</button>
						<a class="Close-Actions-Btn btn btn-danger btn-close">
							<i class="ion-ios-close-empty"></i>
						</a>
                    </div>
                </div>

                @endforeach

                {{-- If there is no articles published shows this --}}
                @if(! count($reparaciones))
                <div class="Item-Row item-row empty-row">
                    No se han encontrado items
                </div>
                @endif
            </div>
            {!! $reparaciones->render(); !!}
            <br>

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

		var route = "{{ url('vadmin/ajax_delete_reparacion') }}/"+id+"";

		$.ajax({
			url: route,
			method: 'post',             
			dataType: "json",
			data: {id: id},
			success: function(data){
				console.log(data);
				if (data.result == 1) {
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
		confirm_batch_delete(id,'Cuidado!','Está seguro que desea eliminar?');
		
	});

	// ---- Delete ---- //
	function batch_delete_item(id) {

		var route = "{{ url('vadmin/ajax_batch_delete_reparaciones') }}/"+id+"";

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
				location.reload();
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

