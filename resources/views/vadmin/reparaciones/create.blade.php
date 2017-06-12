
@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Reparaciones')

@section('header')
	@section('header_title', 'Ingreso de Reparación') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/reparaciones') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	{{--{!! Html::style('plugins/texteditor/trumbowyg.min.css') !!}
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!} --}}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
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
			<div id="OutPut" class="Hidden">
				<div class="col-md-12 output-data">
					<div  id="ClientNameOutput" class="output-inner"></div>
				</div>
				<div class="col-md-12">
					{!! Form::open(['url' => 'vadmin/reparaciones', 'method' => 'POST', 'id' => 'NewItemForm']) !!}
						<div class="col-md-12">
							Autor: {{ Auth::user()->name }}
							<input type="text" name="user_id" class="Hidden" value="{{ Auth::user()->id }}">
						</div>
						 {!! Form::text('cliente_id', null, ['id' => 'ClienteIdOutput', 'class' => 'form-control Hidden', 'required' => '']) !!} 
						<button id="GeneratePedidoBtn" class="btnSm buttonOk"> Generar Solicitud de Reparación</button>
					{!! Form::close() !!}
				</div>
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
	{{-- <script type="text/javascript" src="{{ asset('plugins/texteditor/trumbowyg.min.js')}} "></script> --}}
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	{{-- <script type="text/javascript" src="{{ asset('plugins/mask/mask.min.js') }}" ></script>   --}}
	<script type="text/javascript" src="{{ asset('plugins/jqueryUi/jquery-ui.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
	@include('vadmin.components.ajaxscripts');
@endsection

@section('custom_js')
	<script>

	
	$('#GeneratePedidoBtn').click(function(e){
		e.preventDefault();

		var id    = $('#ClientNameOutput').val();
		var route = "{{ url('vadmin/ajax_store_reparacion') }}/"+id+"";
		$('#ClientNameOutput').html(loaderSm('Ingresando solicitud de reparación...'));
		$('#NewItemForm').submit();
	});

    </script>
@endsection
