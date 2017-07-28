
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Pedidos')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listado de Pedidos') 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/pedidos/create') }}" class="btn btnSm buttonOther">Nuevo Pedido</a>
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
			@include('vadmin.pedidos.searcher')
            <div class="col-md-12 animated fadeIn main-list">
                @foreach($pedidos as $item)
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
										echo "<span class='custom-badge green-back'>Preparado</span>";
										break;
									case '3':
										echo "<span class='custom-badge blue-back'>Enviado</span>";
										break;
									default:
										echo "<span class='custom-badge blue-back'>Sin estado</span>";
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
						<a href="{{ url('vadmin/pedidos/'. $item->id) }}" class="btnSmall buttonOther">
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
                @if(! count($pedidos))
                <div class="Item-Row item-row empty-row">
                    No se han encontrado items
                </div>
                @endif
            </div>
            {!! $pedidos->render(); !!}
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

