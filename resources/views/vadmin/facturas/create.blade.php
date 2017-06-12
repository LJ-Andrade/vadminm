
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
	<div class="big-form">
		<div class="row inner-row">
			{{-- Inputs --}}
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					{!! Form::label('cliente', 'Cliente') !!}
					{!! Form::select('cliente', $clientes, null, ['id' => 'SelectClientBySelect', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione un cliente']) !!}
				</div>
			</div>
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="form-group">
					{!! Form::label('codigo', 'Buscar por código') !!}
					{!! Form::text('codigo', null, ['id' => 'SelectClientByKey', 'class' => 'form-control']) !!}
				</div>
			</div>
			{{-- Outputs --}}
			<div id="OutPut" class="Hidden">
				<div class="col-md-12 output-data">
					<div id="SmallLoader" class="Hidden"></div>
					<div id="FullOutput" class=""></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-3">
						<button id="GenerateFC" class="button buttonOk"> Preparar Factura</button>
					</div>
				</div>
			</div>
		</div>
	</div> 	
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
	@include('vadmin.components.ajaxscripts');
@endsection

@section('custom_js')
	<script>


	// Get all pedidositems and clientdata		
	$('#SelectClientBySelect').on('change', function(e, p){
		var id     = $(this).chosen().val();
		get_pedidositems(id);
	});

	$("#SelectClientByKey").on( "keydown", function(e) {
		
		if(e.which == 13) {
			var id    = $(this).val();
			get_pedidositems(id);
		}
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

		// $('#GeneratePedidoBtn').click(function(e){
		// 	e.preventDefault();

		// 	var id    = $('#ClientNameOutput').val();
		// 	$('#ClientNameOutput').html(loaderSm('Creando pedido...'));
		// });


		$(document).on('click', '#GenerateFC', function(e) { 
			var output = $('#OutPut');
			var loader = $('#SmallLoader');

			var clientid    = $('#ClientId').val();
			var route       = "{{ url('vadmin/prepare_fc') }}";
			var pedidosToFc = [];  

			$(".AddToFc:checked").each(function() {  
				pedidosToFc.push($(this).attr('data-pedidoitemid'));
			});

			var ids = pedidosToFc;

			$.ajax({
				url: route,
				type: 'post',
				dataType: "json",
				data: {clienteid: clientid, items: ids},
				beforeSend: function(){
					output.removeClass('Hidden');
					loader.removeClass('Hidden');
					loader.html(loaderSm('Creando...'));
				},
				success: function(data){
					loader.addClass('Hidden');
					console.log(data);
					// This redirect to vadmin/facturas/show/4
					window.location = data.id;
				},
				error: function(data){
					console.log('Error');
					$('#Error').html(data.responseText);
				}
			}); 


			
		});



    </script>
@endsection
