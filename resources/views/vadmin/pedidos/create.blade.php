
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
	<div class="big-form">
		<div class="row inner-row">
			{{-- /// --}}
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					{!! Form::label('cliente', 'Cliente') !!}
					{!! Form::select('cliente', $clientes, null, ['id' => 'ClienteBySelect', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione un cliente']) !!}
				</div>
			</div>
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="form-group">
					{!! Form::label('codigo', 'Buscar por código') !!}
					{!! Form::text('codigo', null, ['id' => 'CodigoCliente', 'class' => 'form-control']) !!}
				</div>
			</div>
			{{-- /// --}}
			<div class="col-md-12">
				<span id="ClientNameOutput"></span>
			</div>

			<div class="col-md-12">
				<button id="GeneratePedidoBtn" class="button buttonOk"> Generar Pedido</button>
			</div>
		</div>
	</div> 	
</div>  
<div class="container">
    <div class="row">
        <div id="Cliente">
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

	$('#ClienteBySelect').on('change', function(e, p){
		
		var id    = $(this).chosen().val();
		var route = "{{ url('vadmin/get_client') }}/"+id+"";
		console.log(route);
		get_client(route);
    	
		
		//$('#ClientNameOutput').html(clientname);

	});

	$("#CodigoCliente").on( "keydown", function(e) {
		e.preventSubmit();
		if(e.which == 13) {
			//var route = "{{ url('vadmin/show_products') }}/"+ids+"";
			var id    = $(this).val();
			console.log(id);
			//getClientById(id, route);
		}
	});


				

    </script>
@endsection
