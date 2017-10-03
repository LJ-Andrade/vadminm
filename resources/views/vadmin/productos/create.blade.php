@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Productos')

@section('header')
	@section('header_title', 'Ingreso de nuevo producto') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/productos') }}"><button type="button" class="animated fadeIn btnSmall btnDark">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}
@endsection

@section('content')
	@component('vadmin.components.mainloader') @endcomponent
	<div class="container">
		<div class="row">
			<div id="Error"></div>
        </div>
	    <div class="row">
	    	{!! Form::open(['route' => 'productos.store', 'method' => 'POST', 'files' => true, 'id' => '', 'class' => 'big-form', 'data-parsley-validate' => '']) !!}	
            	@include ('vadmin.productos.form')
				<div class="text-center">
					{!! Form::submit('Ingresar Producto', ['class' => 'button buttonOk btnBig', 'id' => 'InsertItemBtn']) !!}
				</div>
            {!! Form::close() !!}
        </div>
    </div>  
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
	
	<script>

	


	</script>

@endsection


