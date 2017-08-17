
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Pedidos')

{{-- HEAD--}}
@section('header')
	@section('header_title')
		Hoja de Pedido
    @endsection 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/pedidos') }}" class="btn btnSm buttonOther">Volver</a>
		</div>	
	@endsection
@endsection

{{-- STYLES--}}
@section('styles')
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}	
@endsection
{{-- CONTENT --}}
@section('content')
    <div class="container">
		<input type="text" id="Operacion" class="Hidden" value="pedido">{{-- This shows product data display--}}
        <div id="Error"></div>
		<div class="row big-card">
		 	<div class="title">
			    <h2>Cliente: {{ $pedido->cliente->razonsocial}}</h2>
				<div id="ClientData" data-pedidoid="{{ $pedido->id }}" data-clientid="{{ $pedido->cliente->id }}"></div>
				<div id="TipoCte" class="small-text" data-tipocte="{{ $pedido->cliente->tipo_id }}"><b>Tipo de cliente: </b>{{ $tipocte }}</div>
				<div class="small-text"><b>Pedido N°: </b> {{ $pedido->id }} </div>
				<div class="right text-right"><b>Creado el</b> {{ transDateT($pedido->created_at) }} <br> <b>Autor:</b> {{ $pedido->user->name }}</div>
            </div>		
			<div class="content">
				<div class="row">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Cod.</th>
									<th>Producto</th>
									<th>Cantidad</th>
									<th>P.Unit.</th>
									<th class="txR">SubTotal</th>
									<th class="txR">Facturado</th>
								</tr>
							</thead>
							{!! Form::open(['id' => 'NewFcForm']) !!}
							<tbody>
								@if ($pedido->pedidositems->isEmpty() )
									<th>No hay items ingresados</th>
								@else
								@foreach($pedido->pedidositems as $item)
								<tr class="item-row">
									<td>{{ $item->producto->id }}</td>
									<td>{{ $item->producto->nombre }}</td>
									<td>{{ $item->cantidad }}</td>
									<td>$ {{ $item->valor }}</td>
									<td class="txR">$ {{ $item->cantidad * $item->valor }}</td>
									<td class="txR">
										@if( $item->facturado == 1)
											<i class="ion-checkmark-round" style="color: #8DBB61"></i>
										@else
									
										@endif
									</td>
									<td class="delete-item"><a class="Delete-Item" data-id="{{ $item->id }}"><i class="ion-ios-minus"></i></a></td>
								</tr>
								@endforeach 
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="txR">TOTAL S/Iva : $ <b>{{ $total }} </b></td>
									<td></td>
								</tr>
							</tbody>
							{!! Form::close() !!}
							@endif
						</table>
					</div>

					@component('vadmin.components.loaderRow')
						@slot('text')
							Agregando...
						@endslot
					@endcomponent
					{{-- Totals --}} 
					<div class="row">
						<div class="col-md-12">
							<hr class="softhr">
							
							<div class="col-md-6">
								<div class="col-md-6">
									<div><b>Cantidad de items:</b> {{ count($pedido->pedidositems )}}</div> 
									{!! Form::label('estado','Estado del Pedido') !!}
									{!! Form::text('pedidoid', null, ['id' => 'PedidoId', 'class' => 'Hidden']) !!}
									{!! Form::select('estado', ['1' => 'Pendiente', '2' => 'Preparado', '3' => 'Enviado'], $pedido->estado, ['id' => 'PedidoStatus', 'class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-6 text-right">
								{{-- <button id="MakeFcBtn" type="button" class="btn button buttonOk"><i class="ion-share"></i> Facturar</button> --}}
								<a href="{{ URL::to('vadmin/exportPedidoPdf/'.$pedido->id.'/pedido') }}" target="_blank"><button class="btnSmall green-back"><i class="ion-android-exit"></i> Generar Pdf</button></a>
							</div>
						</div>
					</div>
				</div>	
			</div>					
		</div> {{-- / big-card --}}
		<br>
		{{-- Product Finder --}}
		<div class="row wd-container">
			@if(count($pedido->pedidositems) >= 17)
				<div class="col-md-12 horiz-container">
					No se pueden agregar más items
				</div>
			@else
			<div class="col-md-12">
				<b>Agregar producto</b>
				<hr class="softhr">
			</div>
			<div class="col-md-4">
				{!! Form::label('searchbyname', 'Nombre') !!}
				{!! Form::text('searchbyname', null, ['id' => 'CfNombreInput', 'class' => 'form-control']) !!}
			</div>
			<div class="col-md-2">
				{!! Form::label('searchbycode','Código') !!}
				{!! Form::text('searchbycode', null, ['id' => 'CfCodigoInput', 'class' => 'form-control']) !!} 
			</div>
			<div class="col-md-3">
				{!! Form::label('cantidad','Cantidad') !!}
				{!! Form::text('cantidad', null, ['id' => 'CfCantidadInput', 'class' => 'form-control']) !!} 
			</div>
			<div class="col-md-3">
				{!! Form::label('precio','Precio') !!} <br>
				@if( Auth::user()->type =='superadmin' or Auth::user()->type =='admin' )
				{!! Form::text('precio', null, ['id' => 'CfPrecioInput', 'class' => 'form-control']) !!}
				@else
				{!! Form::text('precio', null, ['id' => 'CfPrecioInput', 'class' => 'form-control Hidden']) !!}
				<span id="CfPrecioDisplayUser"></span>
				@endif
			</div>
			{{-- Display Product Name --}}
			<div class="col-md-12 horiz-container">
				<div id="CfOutputPreview" class="inner Hidden"></div>
				<div id="DisplayErrorOutPut" class="inner Hidden"></div>
				<div id="CfLoader"></div>
			</div>
			{{-- Store Product --}}
			<div class="col-md-3 horizontal-btn-container">
				<button id="AddItem" class="btn btnSquareHoriz buttonOk" ><i class="ion-plus-round"></i> Agregar</button>
			</div>
			@endif
		</div>
	</div>  
		
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	{{-- <script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script> --}}
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
	@include('vadmin.components.ajaxscripts')
	@include('vadmin.pedidos.scripts')
@endsection

@section('custom_js')

	<script>

	/////////////////////////////////////////////////
    //                  ADD ITEM                   //
    /////////////////////////////////////////////////

	
	$('#AddItem').on('click',function(e){
		e.preventDefault();
		
		var route             = "{{ url('vadmin/ajax_store_pedidoitem') }}";
		var clientid          = $('#ClientData').data('clientid');
		var sectionColumnName = 'pedido_id';
		var itemId            = $('#ClientData').data('pedidoid');
		var productCode       = $('#CfCodigoInput').val();
		var nombre            = $('#CfNombreInput').val();
		var cantidad          = $('#CfCantidadInput').val();
		var precio            = $('#CfPrecioInput').val();
		var tipo              = $('#TipoCte').data('tipocte');
		var erroroutput       = $('#DisplayErrorOutPut');

		if(productCode == ''){
			erroroutput.html('Debe ingresar un código');
			erroroutput.removeClass('Hidden');
		} else if(cantidad == '') {
			erroroutput.html('Debe ingresar una cantidad');
			erroroutput.removeClass('Hidden');
		} else if(precio == '') {
			erroroutput.html('Debe ingresar un valor');
			erroroutput.removeClass('Hidden');

		} else {

			var data = {};
			data['cliente_id']      = clientid;
			data[sectionColumnName] = itemId;
			data['producto_id']     = productCode;
			data['cantidad']        = cantidad;
			data['valor']           = precio;
			data['tipo']            = tipo;

			addItem(route, data);
		}
	});

	/////////////////////////////////////////////////
    //                  DELETE                     //
    /////////////////////////////////////////////////
	
	// -------------- Single Delete -------------- //
	// --------------------------------------------//
	$(document).on('click', '.Delete-Item', function(e){
		e.preventDefault();
		var id    = $(this).data('id');
		var route = "{{ url('vadmin/ajax_delete_pedidositem') }}/"+id+"";
		deleteRecord(id, route, 'Cuidado!','Desea eliminar este pedido?');
	});


	</script>

@endsection