@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Proveedores')

@section('header')
	@section('header_title', 'Editando: '.$proveedor->razonsocial) 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/proveedores') }}"><button type="button" class="animated fadeIn btnSmall btnDark">Volver</button></a>
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
        <div class="small-form container animated fadeIn">

            {!! Form::model($proveedor, [
                'method' => 'PATCH',
                'url'    => ['/vadmin/proveedores', $proveedor->id],
                'class'  => 'big-form', 'data-parsley-validate' => '',
                'files'  => true
            ]) !!}

            @include ('vadmin.proveedores.form', ['submitButtonText' => 'Update'])

            {!! Form::close() !!}
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

		// ------------------- Textarea Text Editor --------------------------- //
		// Path to icons
		$.trumbowyg.svgPath = '{{ asset('plugins/texteditor/icons.svg') }}';
		// Init
		$('.Textarea-Editor').trumbowyg();

	
	</script>

@endsection