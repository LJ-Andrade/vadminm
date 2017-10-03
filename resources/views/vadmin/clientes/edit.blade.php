@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Clientes')

@section('header')
	@section('header_title', 'Edición de Cliente') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/clientes') }}"><button type="button" class="animated fadeIn btnSmall btnDark">Volver</button></a>
		</div>	    
	@endsection
@endsection

@section('styles')
	{!! Html::style('plugins/texteditor/trumbowyg.min.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}
@endsection

@section('content')
    <div class="container">
        <div class="small-form container animated fadeIn">

            {!! Form::model($cliente, [
                'method' => 'PATCH',
                'url'    => ['/vadmin/clientes', $cliente->id],
                'class'  => 'big-form', 'data-parsley-validate' => '',
                'files'  => true
            ]) !!}

            @include ('vadmin.clientes.editform', ['submitButtonText' => 'Update'])

            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/texteditor/trumbowyg.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
    <script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('plugins/mask/mask.min.js') }}" ></script>
	@include('vadmin.components.ajaxscripts')
@endsection


@section('custom_js')
	<script>

        /////////////////////////////////////////////////
        //            LOAD LOCALIDADES                 //
        /////////////////////////////////////////////////


    
    </script>
@endsection