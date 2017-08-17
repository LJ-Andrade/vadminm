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
	 <div class="container">
		<div class="row">
			<span>Tu nivel de permisos es <b>{{ typeTrd(Auth::user()->type) }}</b></span>
			<hr>
			{{-- Accesos Directos --}}
			
			<a href="{{ route('clientes.index') }}" class="btnSquareR btnBlue"><i class="ion-ios-briefcase"></i> Listado de Cliente</a>
			<a href="{{ route('clientes.create') }}" class="btnSquareR btnBlue"><i class="ion-plus-round"></i> Nuevo Cliente</a>
			<a href="{{ route('clientes.index') }}" class="btnSquareR btnGreen"><i class="ion-ios-briefcase"></i> Listado de Productos</a>
			<a href="{{ route('productos.create') }}" class="btnSquareR btnGreen"><i class="ion-plus-round"></i> Nuevo Producto</a>
			<hr>	
		</div>
		<div class="row">
			<div class="col-md-6 medium-card">
				<div class="inner light-grey-back">
					<div class="col-md-12 title">
						<span><b>Cuentas Corrientes</b></span>
					</div>
			
					<div class="form-group col-md-7">
						{{-- Search By Name --}}
						{!! Form::label('cliente', 'Buscar por nombre') !!}
						{!! Form::text('cliente', null, ['id' => 'ClientAutoComplete', 'class' => 'form-control']) !!}
					</div>
					<div class="form-group col-md-5">
						{{-- Search By Code  --}}
						{!! Form::label('codigo', 'Buscar por código') !!}
						{!! Form::number('codigo', null, ['id' => 'ClientByCode', 'class' => 'form-control', 'min' => '2']) !!}
					</div>
					<div class="col-md-12">
						<button id="ClientByCodeBtn" class="btnSm btnBlue"> Buscar</button>	
					</div>
					<div id="ClientOutPut" class="col-md-12 Hidden">
						<div class="output-box inner-grey-back">
							<h4><b>Cliente seleccionado:</b></h4>
							<div id="ClientData"></div>
							<div id="OutPutForm">
								{!! Form::open(['url' => '', 'method' => 'POST', 'id' => 'GoToAccountForm']) !!}
									<div class="col-md-12">
										<input type="text" name="user_id" class="Hidden" value="{{ Auth::user()->id }}">
									</div>
									{!! Form::text('cliente_id', null, ['id' => 'ClienteIdOutput', 'class' => 'form-control Hidden', 'required' => '']) !!} 
									
									<button id="GoToAccount" class="button buttonOk"> Ver Cuenta</button>
								{!! Form::close() !!}
							</div>
						</div>
					</div>

					<div class="clearfix"></div>
					
				</div>
	 		</div> 	
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
								<input type="text" value="">
								<button id="UpdateStockBtnHome" class="btnSm btnBlue">Actualizar</button>
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
		<div class="row">
			

			{{-- System Dolar Value--}}
			<div class="col-md-3 card-filled ">
				<div class="inner blue-back">
					<span><b>Valor del Dolar</b></span> <br>
					<span>Dolar Libre: {{ $dolarLibre }}</span> <br>
					<span>Dolar Blue: {{ $dolarBlue }}</span>
				</div>
			</div>
			<div class="col-md-3 card-filled">
				<div class="inner blue-back">
					<span><b>Valor del Dolar en el sistema</b></span> <br>
					<div class="bigtext">u$s  <span id="ValorDolarSistema"> {{ $dolarSistema->valor }}</span></div> <br>
					<button class="btnSmSquare buttonOk right-bottom" data-toggle="modal" data-target="#UpdateDolar">Actualizar</button>
				</div>
			</div>


		</div>
	 </div>  



	{{-- Dolar Update Modal --}}
	@component('vadmin.components.modal')
		@slot('id', 'UpdateDolar' )

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

		// Search and Redirect to Client Account
		$('#GoToAccount').click(function(e){
			e.preventDefault();
			var id = $('#ClienteIdOutput').val();

			var route  = "{{ url('vadmin/clientes/cuenta') }}/"+id+"";
			window.location.href = route;
		});

		$('#ConfirmUpdateDolar').click(function(){
			var id       = $('#dolarId').val();
			var newValue = $('#nuevoValorDolar').val();
			var route = "{{ url('vadmin/ajax_update_dolar') }}/"+id+"";
			
			console.log(route);
			$.ajax({
				url: route,
				method: 'post',             
				dataType: "json",
				data: {id: id, value: newValue},
				success: function(data){
					if (data.Status == 1) {
						$('.CloseModal').click();
						$('#ValorDolarSistema').html('').html(data.Value);
						alert_ok('Ok!','Moneda actualizada');
					} else {
						$('.CloseModal').click();
						alert_error('Ups!','Ha ocurrido un error');
					}
				},
				error: function(data)
				{
					// $('#Error').html(data.responseText);
					console.log(data);	
				},
			});

		});

		// Search By Code
		$("#UpdateStockByCode").on( "keydown", function(e) {
			// var id     = $(this).val();
			if(e.which == 13) {
				$('#SearchStockBtn').click();
			}
		});

		$('#SearchStockBtn').click(function(){
			var id     = $("#UpdateStockByCode").val();
			var route  = "{{ url('vadmin/get_product_stock') }}/"+id+"";
			var output = $('#StockUpdateOutput');
			
			getProductStock(route, output);
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
				var id     = ui.item.id;
				var route  = "{{ url('vadmin/get_product_stock') }}/"+id+"";
				var output = $('#StockUpdateOutput');
				getProductStock(route, output);
			}
		});

		function getProductStock(route, output){

				$.get(route, function(data){
				if(data.exist==1){
					$('#StockOutPut').removeClass('Hidden');
					output.html('');
					stock = data.stock;
					var html =  "<div id='SelectedProdId' data-prodid="+ data.id +"><b>Producto: "+ data.product +"</b></div>"+
								"<div id='StockActual'>Stock Actual: "+ stock +"</div>"+
							    "<div>Stock Min.: "+ data.stockmin +" | Stock Max.: "+ data.stockmax +"</div>"+
								"<input id='PrevStock' type='text' value='"+ stock +"' class='Hidden'/>";
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
	
		// Update Stock when press enter
		$("#NewStockUpdate input").on( "keydown", function(e) {
			if(e.which == 13) {
				$('#UpdateStockBtnHome').click();
			}
			
		});

		// Update Stock when click button
		$("#UpdateStockBtnHome").on( "click", function(e) {
			// e.preventDefault();
			var id       = $('#SelectedProdId').data('prodid');
			var route    = "{{ url('vadmin/update_prod_stock') }}/"+id+"";
			var value    = $('#NewStockUpdate input').val();
			var oldstock = $('#PrevStock').val();

			// Update Stock
			sumStock(route, id, value);

			// Displays new stock
			
			$('#StockOutPut').addClass('Hidden');
			$('#StockOutPutMessage').removeClass('Hidden');
			// var newstock = (parseInt(oldstock) + parseInt(value));
			// $('#StockActual').html("Stock Actual: " + newstock);
			
		});

		

	</script>

@endsection
