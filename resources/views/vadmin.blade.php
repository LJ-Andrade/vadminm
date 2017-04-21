@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Mataderos Distribuciones')

@section('header_title', 'Inicio | ')

@section('header_subtitle')
	Bienvenido <b>{{ Auth::user()->name }}</b>
@endsection

@section('styles')
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}
@endsection

@section('content')
	 <div class="container">
		<div class="row">
		@component('vadmin.components.mainloader')@endcomponent
			<span>Tu nivel de permisos es <b>{{ typeTrd(Auth::user()->type) }}</b></span>
			<hr>
			Vendedores activos:
			@foreach ($vendedores as $vendedor)
			<span class="badge">{{ $vendedor->name }}</span>
			@endforeach
			<hr>	
		</div>
		<div class="row">
			{{-- Stock Update Component --}}
			<div class="col-md-6 medium-card">
				<div class="inner light-green-back">
					<div class="row">
						<div class="col-md-12 title">
							<span><b>Actualizar Stock</b></span>
						</div>
						{!! Form::open(['method' => 'POST', 'id' => 'UpdateStockForm']) !!}	
						<div class="col-md-6">
							{!! Form::label('familia_id', 'Familia') !!}
							{!! Form::select('familia_id', $familias, null, ['id' => 'FamiliasSelect', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una familia', 'required' => '']) !!}
							{!! Form::label('producto', 'Producto') !!}
							<select name="producto" id="ProductSelect" class="form-control Select-Chosen" required="" placeholder="Seleccione una subfamilia">
							</select>
						</div>
						<div class="col-md-6">
							{!! Form::label('familia_id', 'Subfamilia') !!}
							<select name="subfamilia_id" id="SubfamiliasSelect" class="form-control Select-Chosen" required="" placeholder="Seleccione una subfamilia">
							</select>
						
						</div>
						{{-- <div class="col-md-12">
							{!! Form::label('codigo', 'Código') !!}
							{!! Form::text('codigo', null, ['id' => 'ProductCode', 'class' => 'form-control', 'placeholder' => 'Buscar por código']) !!}
						</div> --}}
						<div class="col-md-12">
							<div id="ProductOutput">
							
							</div>
						</div>
						{!! Form::close() !!}

						<button id="UpdateStockBtn" class="btnSmSquare buttonOther right-bottom">Actualizar</button>
					</div>
				</div>
			</div>
			{{-- Stock Update Component --}}
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

	</script>

@endsection
