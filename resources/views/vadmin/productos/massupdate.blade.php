@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Productos')

@section('header')
	@section('header_title', 'Actualización por proveedor') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/productos') }}"><button type="button" class="animated fadeIn btnSmall btnDark">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')
	@component('vadmin.components.mainloader') @endcomponent
	@include('vadmin.components.getprovider')
	<div id="UpdateProviderPriceForm" class="narrow-form Hidden">
		<div class="inner">
			<div class="content">
				<div class="form-group">
					<label for=""><b>Nuevo Valor</b></label>
					<div class="input-group">
						<span class="input-group-addon">%</span>
						<input id="NewPercentProvider" type="number" class="form-control" name="email" placeholder="Ingrese porcentaje">
					</div>
				</div>
				<button id="UpdatePriceProviderBtn" class="button btnGreen">Actualizar Lista</button>
				<div class="foot-info"><i class="ion-alert-circled"></i> Esta operación puede demorar dependiendo la cantidad de proveedores existentes. Espere a que finalice para evitar périda de datos</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div id="Error"></div>
	</div>
@endsection

@section('scripts')
	@include('vadmin.components.ajaxscripts')
@endsection

@section('custom_js')
	<script>

		$('#UpdatePriceProviderBtn').click(function(){
			var id         = $('#ProviderIdOutput').val();
			var route      = "{{ url('vadmin/providerPriceUpdate') }}/"+id+"";
			console.log(route);
			var newPercent = $('#NewPercentProvider').val();
			
			if (newPercent != '') {
				$.ajax({
					url: route,
					method: 'POST',             
					dataType: 'JSON',
					data: {percent: newPercent},
					beforeSend: function(){
						$('#UpdatePriceProviderBtn').html(loaderSm(' Actualizando...'));
					},
					success: function(data){
						console.log(data);
						$('#Error').html('');
						$.each(data.results, function( index, value ) {
							$('#Error').append(index + ': Costo pesos: '+value.costopesos+' | Costo dolar: '+value.costodolar+' | Costo Euro: '+value.costoeuro+'<br>');
						});
						$('#UpdatePriceProviderBtn').html('Ok!');
					},
					error: function(data){
						console.log(data);
						$('#Error').html(data.responseText);
						$('#UpdatePriceProviderBtn').html('Actualizar');
					},
				});
			} else {
				alert_error('...', 'No ha ingresado un porcentaje');
			}
		});

	</script>
@endsection


