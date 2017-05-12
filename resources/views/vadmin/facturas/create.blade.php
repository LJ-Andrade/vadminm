@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Facturas')

@section('header')
	@section('header_title', 'Creación de Facturas') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/facturas') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
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
    <div id="Error"></div>
        
    <div class="container">
        @include('vadmin.components.getclient')

		{{-- Obtener Pedidos --}}

		<div class="big-form">
			<div class="row inner-row">
				<div><input id="ClienteId" type="text" name="ClienteId"></div>
				{{-- /// --}}
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div id="PedidosOutput"></div>
				</div>
			</div>
		</div> 	

      
		<div class="row big-card">
		 	<div class="title">
			    <h2>Cliente: <span id="ClienteNombre"></span></h2>
			    <div>Código: <span id="ClienteCodigo"></span></div>
				<div class="small-text">Cuit: <span id="ClienteCuit"></span></div>

				<div class="topright text-right">
					{!! Form::select('cliente', ['A','B','C'], null, ['id' => '', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Tipo de FC']) !!}
					<br>
					Fecha: {{   date("y/m/d") }}
				</div>
			</div>		
			<div class="content">
				<div class="row">
					<div class="col-md-12 subtitle">
						<div class="col-md-3 col-sm-3">Item</div>
						<div class="col-md-3 col-sm-3">Cantidad</div>
						<div class="col-md-3 col-sm-3">Precio U.</div>
						<div class="col-md-3 col-sm-3">SubTotal</div>
					</div>
					{{-- if no hay nada --}}
					<div class="col-md-12">
						No hay items ingresados
					</div>
				    {{-- if no hay nada --}}
					
					<div id="" class="Item-Row col-md-12 item-row">
						<div class="col-md-3 col-sm-3"><span>0</span></div> 
						<div class="col-md-3 col-sm-3"><span>0</span>	</div>
						<div class="col-md-3 col-sm-3"><span>0</span>	</div>
						<div class="col-md-3 col-sm-3"><span>0</span></div>
						<div class="delete-item"><a class="Delete-Item"><i class="ion-ios-minus"></i></a></div>
					</div>
			
					{{-- Totals --}} 
					<div class="row">
						<div class="col-md-12">
							<hr class="softhr">
							<div class="col-md-3 pull-right">
								TOTAL: <b>$ 0</b>
							</div>
						</div>
					</div>
                    <hr class="softhr">	
				</div>	
			</div>		
			<div class="right-bottom">
				<button class="btn button buttonOk"><i class="ion-share"></i> Facturar</button>
				<button class="btn button buttonOther"><i class="ion-paper-airplane"></i> Preparar</button>
				<button class="btn button grey-back"><i class="ion-ios-printer"></i> Imprimir</button>
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
	@include('vadmin.components.ajaxscripts');
@endsection

@section('custom_js')
	<script>

		$(document).on('click', '#ClientOk', function() {
			var output = $('#PedidosOutput');
			var id     = $('#ClienteId').val();
			var route  = "{{ url('vadmin/ajax_get_pedidos') }}/"+id+"";

			$.ajax({
				url: route,
				method: "get",
				dataType: "json",
				success: function(data){
					// console.log(data.response);
					if(data.response == 0){
						$('#ClientNameOutput').html('El cliente no tiene pedidos pendientes');
					} else if(data.response == 1) {
						$('#GetClientForm').addClass('Hidden');
						$('#PedidosOutput').html(data.pedidos);
						
						console.log(data.pedidos);
						$.each( data.pedidos, function(data, key) {
							var div = "<span>"+ data + ' ' + key +"</span></br>"
							$('#PedidosOutput').append(div);
							// console.log();
						});

					} else {
						console.log(data);
					}
				},
				error: function(data)
				{
					// $('#Error').html(data.responseText);
					console.log(data);
				}
			});
		});
		
    </script>
@endsection