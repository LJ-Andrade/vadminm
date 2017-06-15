
@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Facturas')

@section('header')
	@section('header_title', 'Nueva factura') 
	@section('header_subtitle')
		| Autor: {{ Auth::user()->name }}
		<input type="text" name="user_id" class="Hidden" value="{{ Auth::user()->id }}">
	@endsection

	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/pedidos') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	{{-- {!! Html::style('plugins/texteditor/trumbowyg.min.css') !!} --}}
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}
@endsection

@section('content')

<div class="container">
	<div id="Error"></div>
	{{-- //// SEARCH AND SET CLIENT //// --}}
	<div id="ClientFinder" class="narrow-form">
		<div class="inner">
			{{-- Title --}}
			<div class="sub-title">
				<span>Seleccionar cliente</span>
			</div>
			{{-- By Name Search --}}
			<div class="form-group">
				{!! Form::label('cliente', 'Buscar por nombre') !!}
				{!! Form::text('codigo', null, ['id' => 'ClientAutoComplete', 'class' => 'form-control']) !!}
			</div>
			{{-- By Code Search --}}
			<div class="form-group">
				{!! Form::label('codigo', 'Buscar por código') !!}
				{!! Form::number('codigo', null, ['id' => 'ClientByCode', 'class' => 'form-control']) !!}
				<button id="ClientByCodeBtn" class="btnSm btnBlue"> Buscar</button>
			</div>
		
			{{-- Output --}}
			<div id="SmallLoader"></div>
			<div id="ClientOutPut" class="Hidden">
				<div class="output-box">
					<h4>Cliente seleccionado:</h4>
					<div id="ClientData"></div>
					<div id="OutPutForm">
						{!! Form::open(['url' => 'vadmin/pedidos', 'method' => 'POST', 'id' => 'NewItemForm']) !!}
							<div class="col-md-12">
								<input type="text" name="user_id" class="Hidden" value="{{ Auth::user()->id }}">
							</div>
							{!! Form::text('cliente_id', null, ['id' => 'ClienteIdOutput', 'class' => 'form-control Hidden', 'required' => '']) !!} 
							<br>
							<button id="OpenFcBtn" class="button buttonOk"> Ok</button>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<div id="ClientError" class="output-box Hidden">
				El cliente no existe
			</div>
		</div>
	</div>
 		
	{{-- //// FC BODY //// --}}
	<div id="FcBody" class="big-form Hidden">
		<div class="row inner-row">
			<div class="col-md-6 col-xs-12 pull-right text-right">
			<b>Fecha:</b> {{ date("d/m/y") }} <br>
			<b>Factura:</b>
			<select name="tipo_fc" id="">
				<option value="A">A</option>
				<option value="B">B</option>
			</select>
			</div>
			<div class="col-md-6 col-xs-12">
				<div><b>		Razón Social:</b> <span id="RazonSocial"></span></div>
				<div><b>		CUIT:        </b> <span id="Cuit"></span></div>
				<div><b>		Vendedor:    </b> <span id="Vendedor"></span></div>
				<div><b>		TipoCte:     </b> <span id="TipoCte"></span></div>
				<div><b>		Flete:       </b> <span id="Flete"></span></div>
			</div>
		</div>
		<hr>
		<div class="inner-row">
			<div id="SmallLoader"></div>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Cod.</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>P.Unit.</th>
							<th>Iva</th>
							<th>SubTotal</th>
						</tr>
					</thead>
					
					{!! Form::open(['url' => 'vadmin/crear_fc', 'method' => 'POST', 'id' => 'NewFcForm']) !!}
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>TOTAL: $ <b></b></td>
						</tr>
					</tbody>
					{!! Form::close() !!}
					
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
						<div>Cantidad de items: </div> <br>
						
					</div>
					<div class="col-md-6 text-right">
						<button id="MakeFcBtn" type="button" class="btn button buttonOk"><i class="ion-share"></i> Facturar</button>
						<button type="button" class="btn button grey-back"><i class="ion-ios-printer"></i> Imprimir</button>
					</div>
				</div>
			</div>
		</div>
	<button id="ProductFinderBtn" class="btn btnSquareHoriz btnBlue" ><i class="ion-plus-round"></i> Agregar Item</button>
	<button id="PendingOrdersBtn" class="btn btnSquareHoriz btnYellow" ><i class="ion-plus-round"></i> Pedidos Pendientes</button>
	</div> {{-- / big-form FC BODY--}}
	{{-- //// Product Finder //// --}}
	<div id="ProductFinder" class="wd-container Hidden">
		<div class="CloseBtn closeButton"><i class="ion-close-round"></i></div>
		<div class="row">
			<div class="col-md-12">
				<div class="title">Agregar producto</div>
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
			{{-- Preview Product Name --}}
			
			<div class="col-md-12 horiz-container">
				<div id="CfOutputPreview" class="inner Hidden"></div>
				<div id="DisplayErrorOutPut" class="inner Hidden"></div>
				<div id="CfLoader"></div>
			</div>
			{{-- Add Product To Fc --}}
			<div class="col-md-3 horizontal-btn-container">
				<button id="AddItem" class="btn btnSquareHoriz buttonOk" ><i class="ion-plus-round"></i> Agregar</button>
			</div>
			
		</div>

	</div> {{-- /wd-container Product Finder --}}

	{{-- //// Pend Orders //// --}}
	<div id="PendingOrders" class="wd-container Hidden">
		<div class="CloseBtn closeButton"><i class="ion-close-round"></i></div>
		<div class="row">
			<div class="col-md-12">
				<div class="title">Pedidos Pendientes</div>
			</div>
			<div class="col-md-12 table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Cod.</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>P.Unit.</th>
							<th>Iva</th>
							<th>SubTotal</th>
						</tr>
					</thead>
					

					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
					
				</table>
			</div>
			
		{{-- Add Product To Fc --}}
		<div class="col-md-3 horizontal-btn-container">
			<button id="" class="btn btnSquareHoriz buttonOk" ><i class="ion-plus-round"></i> Agregar</button>
		</div>
		</div>

	</div> {{-- /wd-container Pedidos --}}




	

</div>  
@endsection

@section('scripts')
	{{-- <script type="text/javascript" src="{{ asset('plugins/texteditor/trumbowyg.min.js')}} "></script> --}}
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/mask/mask.min.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('plugins/jqueryUi/jquery-ui.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
	@include('vadmin.components.ajaxscripts')
@endsection

@section('custom_js')
	<script>

	$('#OpenFcBtn').click(function(){
		$('#FcBody').removeClass('Hidden');
		$('#ClientFinder').addClass('Hidden');
	});
	

	$('#ProductFinderBtn').click(function(){
		$('#ProductFinder').removeClass('Hidden');
	});
	
	$('#PendingOrdersBtn').click(function(){
		$('#PendingOrders').removeClass('Hidden');
	});

	$('.CloseBtn').click(function(){
		$(this).parent().addClass('Hidden');
	});

	/////////////////////////////////////////////////////////
	//             Get and Set Client Data                 //
	/////////////////////////////////////////////////////////

	// Get Client Data On Button Click
	$('#ClientByCodeBtn').click(function(){
		// Get Client Full Data
		
		var id         = $('#ClientByCode').val();
		var route      = "{{ url('vadmin/get_client') }}/"+id+"";
		
		getClientData(route).done(function(data){
			
			if (data.client != null){
				var id          = data.client['id'];
				var razonsocial = data.client['razonsocial'];
			} 
			// Send Client Data to Output
			output(id, razonsocial)

		});
	});

	// Get Client Data OnKeydown
	$("#ClientByCode").on("keydown", function(e) {
		if(e.which == 13) {
			$('#ClientByCodeBtn').click();
		}
	});
	
	// Get Client Data On Autocomplete Input
	$('#ClientAutoComplete').autocomplete({
		source: "{!!URL::route('client_autocomplete')!!}",
		minlength: 1,
		autoFocus: true,
		search: function(){
			$('#SmallLoader').html(loaderSm('Buscando...'));
		},
		select:function(e,data)
		{
			var id    = data.item.id;
			var route = "{{ url('vadmin/get_client') }}/"+id+"";

			// Get Client Full Data
			getClientData(route).done(function(data){
				var id          = data.client['id'];
				var razonsocial = data.client['razonsocial'];

				// Send Client Data to Output
				output(id, razonsocial)
			});
			
		},
		response: function(event, ui) {
			$('#SmallLoader').html('');
		},
	});

	// Print Selected Data and Fill Inputs
	function output(id, razonsocial){
		var output      = $('#ClientData');
		var outputerror = $('#ClientError');

		if(id != null){
			$('#ClienteIdOutput').val(id);
			$('#ClientOutPut').removeClass('Hidden');
			output.html('Cód.:' + id + ' | ' + razonsocial);
			outputerror.addClass('Hidden');
		} else {
			$('#ClientOutPut').addClass('Hidden');
			outputerror.removeClass('Hidden');
		}
	}

	/////////////////////////////////////////////////////////
	//                    MAKE FC                          //
	/////////////////////////////////////////////////////////

	$('#OpenFcBtn').click(function(e){
		e.preventDefault();
		var id    = $('#ClienteIdOutput').val();
		var route = "{{ url('vadmin/get_client_data') }}/"+id+"";
		
		var razonsocial = '';
		var cuit        = '';
		var tipocte     = '';
		var vendedor    = '';
		var flete       = '';

		// Get Client Data
		getClientData(route).done(function(data){
			
			if (data.client != null){
				razonsocial = $('#RazonSocial').html(data.client['razonsocial']);
				cuit        = $('#Cuit').html(data.client['cuit']);
				tipocte     = $('#TipoCte').html(data.client['tipo_id']);
				vendedor    = $('#Vendedor').html(data.client['vendedor']);
				flete       = $('#Flete').html(data.client['flete_id']);

				
				
				
				
				

			}

			console.log(data.client);
			console.log(razonsocial);
			console.log(cuit);
			console.log(tipocte);
			console.log(vendedor);
			console.log(flete);
			
		});
		
	});

	// Get all pedidositems and clientdata Function
	function get_pedidositems(id) {

		var client = $('#ClientNameOutput');
		var output = $('#OutPut');
		var loader = $('#SmallLoader');
		var route  = "{{ url('vadmin/get_pedidositems_fc') }}/"+id+"";

		$.ajax({
			url: route,
			type: 'post',
			beforeSend: function(){
				output.removeClass('Hidden');
				loader.removeClass('Hidden');
				loader.html(loaderSm('Buscando...'));
			},
			success: function(data){
				$('#FullOutput').html(data);
				loader.addClass('Hidden');
			},
			error: function(data){
				console.log('Error');
				$('#Error').html(data.responseText);
			}
		}); 
	
	}


	/////////////////////////////////////////////////////////
	//                    Perform FC                       //
	/////////////////////////////////////////////////////////



    </script>
@endsection
