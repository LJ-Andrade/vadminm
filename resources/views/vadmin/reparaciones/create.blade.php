
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

	
		 Trabajando en esta sección


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
