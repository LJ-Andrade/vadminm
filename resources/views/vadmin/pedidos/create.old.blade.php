@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Pedidos')

@section('header')
	@section('header_title', 'Creación de Pedidos') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/pedidos') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	{!! Html::style('plugins/texteditor/trumbowyg.min.css') !!}
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}
@endsection


@section('content')

<div class="container">
	<div class="row">
		{!! Form::open(['method' => 'POST', 'files' => true, 'id' => 'NewItemForm', 'class' => 'big-form', 'data-parsley-validate' => '']) !!}	
		<div class="row inner-row">
			{{-- /// --}}
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="form-group">
					{!! Form::label('cliente', 'Cliente') !!}
					{!! Form::select('cliente', $clientes, null, ['id' => 'ClienteId', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
				</div>
				<button id="GeneratePedidoBtn" class="button buttonOk"> Generar Pedido</button>
			</div>
			{{-- /// --}}
			<div class="col-md-4 col-sm-6 col-xs-12">
				

			</div>
		</div>
		{!! Form::close() !!}
		{!! Form::open(['method' => 'POST', 'files' => true, 'id' => 'NewPedidositemsForm', 'class' => 'big-form', 'data-parsley-validate' => '']) !!}	
		<div class="row inner-row">
			{{-- /// --}}
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="client_data">
					<div id="ClienteDataNombre"></div>
					<div id="ClienteDataDomicilio"></div>
					<div id="ClienteDataCondicVta"></div>
					{{-- Hidden Fields --}}
					{!! Form::text('cliente_id', null, ['id' => 'ClienteIdInput', 'class' => 'form-control Hidden']) !!}
					{!! Form::text('pedido_id', null, ['id' => 'PedidoIdInput', 'class' => 'form-control Hidden']) !!}
				</div>
			</div>
		</div>
		<div class="row inner-row">
			<div class="col-md-4">
				{!! Form::label('producto_id', 'Producto') !!}
				{!! Form::select('producto_id', $productos, null, ['id' => 'ProductoIdSelect', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
			</div>
			<div class="col-md-4">
				{!! Form::label('cantidad', 'Cantidad') !!}
				{!! Form::text('cantidad', null, ['id' => 'CantidadInput', 'class' => 'form-control', 'placeholder' => 'Seleccione una opcion']) !!}
			</div>
			<div class="col-md-4">
				{!! Form::label('valor', 'Valor') !!}
				{!! Form::text('valor', null, ['id' => 'ValorInput', 'class' => 'form-control', 'placeholder' => 'Seleccione una opcion']) !!}
			</div>
		</div>
		<hr class="softhr">
		<div class="row inner-row">
			<div class="col-md-12">
				<button id="AgregarItemBtn" class="button buttonOk"> Agregar Item</button>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div> 
<br>
<div class="container">
	<div class="row">
		<div id="PedidosContainer" class="col-md-12 animated fadeIn main-list">
			
			
		</div> 
	</div>
</div> 
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/texteditor/trumbowyg.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/mask/mask.min.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
@endsection

@section('custom_js')
	<script>
		$('#NewPedidositemsForm').hide();

		$('#GeneratePedidoBtn').click(function(e){
			e.preventDefault();

			$('#NewItemForm').hide(100);
			$('#NewPedidositemsForm').show(100);

			var id       = $('#ClienteId option:selected').val();
			var route    = "{{ url('vadmin/ajax_store_pedido') }}/"+id+"";
			var pedidoid;
			$.ajax({
				url: route,
				type: 'post',
				dataType: 'json',
				data: {cliente_id: id},
				success: function(data){
					$('#PedidoIdInput').val(data.pedidoid);
					$('#NewPedidositemsForm').removeClass('Hidden');
				},
				error: function(data){
					console.log(data);
				}
			}); 

			// Get Client Data
			var route2   = "{{ url('vadmin/ajax_get_cliente') }}/"+id
			$.get(route2, function(data){

				$('#ClienteIdInput').val(data.id);
				$('#ClienteDataNombre').html('Razón Social: ' + data.razonsocial + '<br>');
				$('#ClienteDataDomicilio').html('Dirección Fiscal: ' + data.dirfiscal + '<br>');
				$('#ClienteDataCondicVta').html('Condición de Venta: ' + data.condicventas_id + '<br>');
			});
		});

		$('#AgregarItemBtn').click(function(e){
			e.preventDefault();
			var clienteid   = $('#ClienteIdInput').val();
			var pedidoid   = $('#PedidoIdInput').val();
			var productoid = $('#ProductoIdSelect option:selected').val();
			var cantidad   = $('#CantidadInput').val();
			var valor      = $('#ValorInput').val();

			var route   = "{{ url('vadmin/ajax_store_pedidoitem') }}";
			var data    = {cliente_id: clienteid, pedido_id: pedidoid, producto_id: productoid, cantidad: cantidad, valor: valor};
			$.post(route, data, function(data) {
				// console.log(data);
			})
			.done(function(data) {

				var pedidorow = "<div class='Item-Row Select-Row-Trigger row item-row simple-list'>"+
					"<div></div>"+
					"<div class='content'>"+
						"<div class='col-xs-6 col-sm-4 col-md-4 inner'>"+
							"<span><b>"+ data.producto +"</b></span>"+
						"</div>"+
						"<div class='col-xs-6 col-sm-3 col-md-4 inner-tags'>Cantidad: "+ data.cantidad	+"</div>"+
						"<div class='col-xs-6 col-sm-3 col-md-4 inner-tags'>Valor: "+ data.valor	+"</div>"+
					"</div>"+
					"<div class='batch-delete-checkbox'>"+
						"<input type='checkbox' class='BatchDelete' data-id=''>"+
					"</div>"+
				"</div>";

				$('#PedidosContainer').append(pedidorow);

				
			})
			.fail(function(data) {
				console.log(data);
			});
		

		});
				

    </script>
@endsection


