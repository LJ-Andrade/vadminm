
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
			<a href="{{ url('vadmin/facturas') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
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
	<div id="FcBody" class="big-form Hidde">
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
				<input id="TipoCteId" type="text" name="tipoctid" class="Hidden">
				<div><b>		Flete:       </b> <span id="Flete"></span></div>
			</div>
		</div>
		<hr>
		<div class="inner-row">
			<div id="SmallLoader"></div>
			<div class="table-responsive">
				{!! Form::open(['url' => 'vadmin/get_fc_data', 'method' => 'POST', 'id' => 'FcForm']) !!}
					<input id="RazonSocialInput" name='razonsocial' type='hidden' />
					<input id="CuitInput" name='cuit' type='hidden' />
					
					<table class="table">
						<thead>
							<tr>
								<th>Cod.</th>
								<th>Detalle</th>
								<th class="mw50">Cantidad</th>
								<th class="mw100">P.Unit.</th>
								<th class="mw50">Iva</th>
								<th class="mw50">Subtot</th>
								<th></th>
							</tr>
						</thead>
						{{-- Fc Items --}}
					
						<tbody id="FcItems">
						</tbody>
					
						<tbody class="custom-table-body">
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td>Iva: </td> 
								<td id="IvaSubTotal"></td>
								<td></td>
								<input id="IvaSubtotalInput" name='ivasubtotal' type='hidden'  />
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td>Subtotal: </td>
								<td id="SubTotal"></td>
								<td></td>
								<input id="SubTotalInput" name='subtotal' type='hidden'  />
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<input id="TotalInput" name='total' type='hidden'  />
								<td>Total: </td>
								<td id="Total"></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				{!! Form::close() !!}
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
	<div id="ProductFinder" class="wd-container Hidde">
		<div class="CloseBtn closeButton"><i class="ion-close-round"></i></div>
		<div class="row">
			<div class="col-md-12">
				<div class="title">Agregar producto</div>
			</div>
			<div class="col-md-4 col-sm-6">
				{!! Form::label('searchbyname', 'Nombre') !!}
				{!! Form::text('searchbyname', null, ['id' => 'PfNameInput', 'class' => 'form-control']) !!}
			</div>
			<div class="col-md-2 col-sm-6">
				{!! Form::label('searchbycode','Código') !!}
				{!! Form::text('searchbycode', null, ['id' => 'PfCodeInput', 'class' => 'form-control']) !!} 
			</div>
			<div class="col-md-3 col-sm-6">
				{!! Form::label('cantidad','Cantidad') !!}
				{!! Form::text('cantidad', null, ['id' => 'PfAmmountInput', 'class' => 'form-control']) !!} 
			</div>
			<div class="col-md-3 col-sm-6">
				{!! Form::label('precio','Precio') !!} <br>
				@if( Auth::user()->type =='superadmin' or Auth::user()->type =='admin' )
				{!! Form::text('precio', null, ['id' => 'PfPriceInput', 'class' => 'form-control']) !!}
				@else
				{!! Form::text('precio', null, ['id' => 'PfPriceInput', 'class' => 'form-control ']) !!}
				<span id="PfPriceDisplayUser"></span>
				@endif
			</div>
			{!! Form::text('precio', null, ['id' => 'PfProductIva', 'class' => 'form-control Hidden']) !!}
			
			{{-- Preview Product Name --}}
			<div class="col-md-12 horiz-container">
				<div id="PfOutputPreview" class="inner Hidden"></div>
				<div id="DisplayErrorOutPut" class="inner Hidden"></div>
				<div id="PfLoader"></div>
			</div>
			{{-- Add Product To Fc --}}
			<div class="col-md-3 horizontal-btn-container">
				<button id="AddItemtBtn" class="btn btnSquareHoriz buttonOk" ><i class="ion-plus-round"></i> Agregar</button>
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
	@include('vadmin.components.ajaxscripts')
	@include('vadmin.facturas.scripts')
@endsection

@section('custom_js')
	<script>


    </script>
@endsection
