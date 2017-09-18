@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Comprobante')

@section('header')
	@section('header_title', 'Emisión de Comprobantes') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/comprobantes') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')
	@component('vadmin.components.mainloader')@endcomponent
	<div class="container">
		@include('vadmin.comprobantes.getclient')
		@include('vadmin.comprobantes.comprobante')
		@include('vadmin.comprobantes.items')
		{{-- //// -------------- //// --}}
		<div id="DocMessage" class="wd-container Hidden"></div>
		{{-- //// -------------- //// --}}		
		<div id="Error"></div>
	</div>
	
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/mask/mask.min.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('plugins/jqueryUi/jquery-ui.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('js/vadmin_corefunctions.js') }}" ></script>
	@include('vadmin.comprobantes.scripts')
@endsection