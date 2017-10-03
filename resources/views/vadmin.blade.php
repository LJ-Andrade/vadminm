@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Mataderos Distribuciones')

@section('header_title', 'Inicio | ')

@section('header_subtitle')
	Bienvenid@ <b>{{ Auth::user()->name }}</b>
@endsection

@section('styles')
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}
@endsection

@section('content')
	@component('vadmin.components.mainloader')@endcomponent
	 <div class="container dashboard">
	 
		<div class="row">
			{{--  <div class="developer-message">
				<span class="title">Mensaje:</span><br>
				<span class="content">
				
				</span>
			</div> <br>  --}}
			
			<span>Tu nivel de permisos es <b>{{ typeTrd(Auth::user()->type) }}</b></span>
			<hr class="softhr">
			{{-- Accesos Directos --}}
			<a href="{{ route('clientes.create') }}"><button type="button" class="mb btn btn-labeled btnGreen">
				<span class="btn-label"><i class="ion-android-add-circle"></i></span>Cliente</button>
			</a>
			<a href="{{ route('pedidos.create') }}"><button type="button" class="mb btn btn-labeled btnGreen">
				<span class="btn-label"><i class="ion-android-add-circle"></i></span>Pedido</button>
			</a>
			<a href="{{ route('comprobantes.create') }}"><button type="button" class="mb btn btn-labeled btnGreen">
				<span class="btn-label"><i class="ion-android-add-circle"></i></span>Comprobante</button>
			</a>
			<a href="{{ route('productos.create') }}"><button type="button" class="mb btn btn-labeled btnGreen">
				<span class="btn-label"><i class="ion-android-add-circle"></i></span>Producto</button>
			</a>
			<hr class="softhr">	
		</div>
		<div class="row">
			{{-- System Dolar Value--}}
			<div class="col-md-2">
				<!-- COMIENZO codigo del DOLAR-EURO -->
				<div id="CurrencyDashboard">
					<table width=120 border=0 cellspacing=0 cellpadding=0><tr><td align=center>
						<script language="JavaScript" type="text/JavaScript" src="{{ asset('plugins/currencyapi/currencyapi.js') }}"></script>
						<script language="JavaScript" type="text/JavaScript">show(s);</script>
						<noscript></noscript>
						</td></tr>
					</table>
				</div>		
				<!-- FIN codigo del DOLAR-EURO -->
				{{-- <div class="inner blue-back">
					<span><b>Valor del Dolar</b></span> <br>
					<span>Dolar Libre: {{ $dolarLibre }}</span> <br>
					<span>Dolar Blue: {{ $dolarBlue }}</span>
				</div> --}}
			</div>
			<div class="col-md-3 card-filled">
				<div class="inner blue-back">
					<span><b>Valor del Dolar en el sistema</b></span> <br>
					<div class="bigtext">u$s <span id="ValorDolarSistema">{{ $dolarSistema->valor }}</span></div> <br>
					<button class="btnSmSquare buttonOk right-bottom" data-toggle="modal" data-target="#UpdateDolar">Actualizar</button>
				</div>
			</div>
			<div class="col-md-3 card-filled">
				<div class="inner blue-back">
					<span><b>Valor del Euro en el sistema</b></span> <br>
					<div class="bigtext">u$s <span id="ValorEuroSistema">{{ $euroSistema->valor }}</span></div> <br>
					<button class="btnSmSquare buttonOk right-bottom" data-toggle="modal" data-target="#UpdateEuro">Actualizar</button>
				</div>
			</div>
		</div>
		<hr class="softhr">


		<div class="row">
			
			{{-- Stock Update Component --}}
			<div class="col-md-6 medium-card">
				<div class="inner light-grey-back">
				
					<div class="col-md-12 title">
						<span><b>Actualizar Stock</b></span>
					</div>
					{{-- By Name Search --}}
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('productname', 'Buscar por nombre') !!}
							{!! Form::text('productname', null, ['id' => 'UpdateStockByName', 'class' => 'form-control']) !!}
						</div>
					</div>
					<div class="col-md-6">
						{{-- By Code Search --}}
						<div class="form-group">
							{!! Form::label('productcode', 'Buscar por código') !!}
							{!! Form::number('productcode', null, ['id' => 'UpdateStockByCode', 'class' => 'form-control']) !!}
						</div>
					</div>
					<div class="col-md-12">
						<button id="SearchStockBtn" class="btnSm btnBlue"> Buscar</button>	
					</div>
					<div id="StockOutPut" class="col-md-12 Hidden">
						<div class="output-box inner-grey-back">
							<div id="StockUpdateOutput"></div>
							<div id="NewStockUpdate" class="Hidden">
								<div class="form-group">
									<div class="form-inline">
										{!! Form::select('stockorigin', ['stock1' => 'Depósito', 'stock2' => 'Local'], null, ['id' => 'UpdateStockOrigin', 'class' => 'form-control']) !!}
										{!! Form::number('sumstock', null, ['id' => 'UpdateStockQuantity', 'class' => 'form-control', 'placeholder' => 'Cantidad']) !!}
										<button id="UpdateStockBtnHome" class="btnSm btnBlue">Actualizar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div id="StockOutPutMessage" class="output-box inner-grey-back Hidden">Stock Actualizado</div>
				</div>
			</div>
			{{-- Stock Update Component --}}
			
		</div>
		<br>
		
	 </div>  



	{{-- Dolar Update Modal --}}
	@component('vadmin.components.modal')
		@slot('id', 'UpdateDolar')

		@slot('title')
			<b>Actualizar el valor de moneda</b>
		@endslot

		@slot('content')
			{!! Form::open(['id'=>'UpdateDolarForm']) !!}
			{!! Form::text('moneda', $dolarSistema->id, ['id' => 'dolarId', 'class' => 'form-control Hidden', 'placeholder' => 'Seleccione una moneda...']) !!}
			<br>
			{!! Form::text('dolar', null, ['id' => 'nuevoValorDolar', 'class' => 'form-control', 'placeholder' => 'Nuevo valor...']) !!}
		@endslot

		@slot('ok_button')
			<button id="ConfirmUpdateDolar" type="button" class="button buttonOk"><i class="ion-checkmark-round"></i> Confirmar</button>
			{!! Form::close() !!}
		@endslot

	@endcomponent

	
	{{-- Euro Update Modal --}}
	@component('vadmin.components.modal')
		@slot('id', 'UpdateEuro')

		@slot('title')
			<b>Actualizar el valor de moneda</b>
		@endslot

		@slot('content')
			{!! Form::open(['id'=>'UpdateEuroForm']) !!}
			{!! Form::text('moneda', $euroSistema->id, ['id' => 'euroId', 'class' => 'form-control Hidden', 'placeholder' => 'Seleccione una moneda...']) !!}
			<br>
			{!! Form::text('dolar', null, ['id' => 'nuevoValorEuro', 'class' => 'form-control', 'placeholder' => 'Nuevo valor...']) !!}
		@endslot

		@slot('ok_button')
			<button id="ConfirmUpdateEuro" type="button" class="button buttonOk"><i class="ion-checkmark-round"></i> Confirmar</button>
			{!! Form::close() !!}
		@endslot

	@endcomponent



	<div id="Error"></div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('js/products.js') }}" ></script>
	@include('vadmin.components.ajaxscripts')
@endsection

@section('custom_js')

	<script type="text/javascript">


		// Update Dolar
		$('#ConfirmUpdateDolar').click(function(){
			var id       = $('#dolarId').val();
			var newValue = $('#nuevoValorDolar').val();
			updateCurrency(id, newValue);
		});

		// Update Euro
		$('#ConfirmUpdateEuro').click(function(){
			var id       = $('#euroId').val();
			var newValue = $('#nuevoValorEuro').val();
			updateCurrency(id, newValue);
		});

		function updateCurrency(id, newValue)
		{	
			var route = "{{ url('vadmin/update_currency_value') }}/"+id+"";
			$.ajax({
				url: route,
				method: 'post',             
				dataType: "json",
				data: {id: id, value: newValue},
				success: function(data){
					if (data.Status == 1) {
						$('.CloseModal').click();
						// $('#ValorEuroSistema').html('').html(data.Value);
						alert_ok('Ok!','Moneda actualizada');
						location.reload();
					} else {
						$('.CloseModal').click();
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

		// Search By Code
		$("#UpdateStockByCode").on( "keydown", function(e) {
			if(e.which == 13) {
				$('#SearchStockBtn').click();
			}
		});

		$('#SearchStockBtn').click(function(){
			var id     = $("#UpdateStockByCode").val();
			var route  = "{{ url('vadmin/get_product_stock') }}/"+id+"";
			getProductStock(route);
			$('#StockOutPutMessage').addClass('Hidden');
		});

		// Search By Name Autocomplete Product Name Input
	
		$('#UpdateStockByName').autocomplete({
			source: "{!!URL::route('autocomplete')!!}",
			minlength: 1,
			autoFocus: true,
			search: function()
			{
				// Loader
			},
			select: function(e,ui)
			{
				var id     = ui.item.codigo;
				$('#UpdateStockByCode').val(id);
			}
		});

		// Update Stock when press enter
		//$("#NewStockUpdate input").on( "keydown", function(e) {
		//	if(e.which == 13) {
		//		$('#UpdateStockBtnHome').click();
		//	}
		//});

		// Update Stock when click button
		$("#UpdateStockBtnHome").on("click", function(e) {
			// e.preventDefault();
			var id       = $('#SelectedProdId').data('prodid');
			var code     = $('#SelectedProdCode').val();
			var origin   = $('#UpdateStockOrigin').val();
			var route    = "{{ url('vadmin/update_prod_stock') }}/"+id+"";
			var value    = $('#UpdateStockQuantity').val();
			var oldstock = $('#PrevStock').val();
			// Update Stock
			sumStock(route, id, value, origin);

			// Displays new stock
			var routeResponse  = "{{ url('vadmin/get_product_stock') }}/"+code+"";
			getProductStock(routeResponse);
		
		});

			function getProductStock(route){
				var output = $('#StockUpdateOutput');
				$.get(route, function(data){
				if(data.exist==1){
					$('#StockOutPut').removeClass('Hidden');
					output.html('');
					stock1 = data.stock1;
					stock2 = data.stock2;
					var html =  "<div id='SelectedProdId' data-prodid="+ data.id +"><b>Producto: "+ data.product +"</b></div>"+
								"<input id='SelectedProdCode' type='hidden' value="+ data.codigo +">"+
								"<div id='StockActual'>Depósito: "+ stock1 +" | Local: " + stock2 +"</div>"+
							    "<div>Stock Min.: "+ data.stockmin +" | Stock Max.: "+ data.stockmax +"</div>"+
								"<input id='PrevStock' type='text' value='"+ stock1 +"' class='Hidden'/>";
					$('#NewStockUpdate').removeClass('Hidden');
					output.removeClass('Hidden');
					output.html(html);
				} else {
					var html = "<div>El producto no existe</div>";
					$('#NewStockUpdate').addClass('Hidden');
					output.removeClass('Hidden');
					output.html('');
					output.html(html);
				}	
			});
		}
	

	</script>

@endsection
