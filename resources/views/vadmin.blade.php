@extends('vadmin.layouts.main')
@section('title', 'Vadmin | Mataderos Distribuciones')
@section('header_title', 'Inicio | ')
@section('header_subtitle')
	Bienvenido <b>{{ Auth::user()->name }}</b>
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
			{{-- <iframe src="http://ws.geeklab.com.ar/dolar/dolar-iframe.php" height="60" width="160" frameborder="0" scrolling="no"></iframe> --}}
			<div class="col-md-3 card-filled blue-back">
				<span><b>Valor del Dolar</b></span> <br>
				<span>Dolar Libre: {{ $dolarLibre }}</span> <br>
				<span>Dolar Blue:  {{ $dolarBlue }}</span>
			</div>
			<div class="col-md-3 card-filled blue-back">
				<span><b>Valor del Dolar en el sistema</b></span> <br>
				<div class="bigtext">u$s  <span id="ValorDolarSistema"> {{ $dolarSistema->valor }}</span></div> <br>
				<button class="btnSmSquare buttonOk right-bottom" data-toggle="modal" data-target="#UpdateDolar">Actualizar</button>
			</div>

		</div>
	 </div>  



@component('vadmin.components.modal')
	@slot('id' )
		UpdateDolar
	@endslot

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
