
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
	<div class="row">
		{!! Form::open(['method' => 'POST', 'files' => true, 'id' => 'NewItemForm', 'class' => 'big-form', 'data-parsley-validate' => '']) !!}	
		<div class="row inner-row">
			{{-- /// --}}
			<div class="col-md-6">
				<div class="col-md-6">
					<div class="form-group">
						{!! Form::label('cliente', 'Cliente') !!}
						{!! Form::select('cliente', $clientes, null, ['id' => 'ClienteId', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione un cliente']) !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						{!! Form::label('codigo', 'Buscar por código') !!}
						{!! Form::text('codigo', null, ['id' => 'CodigoCliente', 'class' => 'form-control']) !!}
					</div>
				</div>
				<div class="col-md-12">
					<button id="GeneratePedidoBtn" class="button buttonOk"> Generar Pedido</button>
				</div>
			</div>
			{{-- /// --}}
			<div class="col-md-4 col-sm-6 col-xs-12">
				

			</div>
		</div>
		{!! Form::close() !!}

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
@endsection

@section('custom_js')
	<script>

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
