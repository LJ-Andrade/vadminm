@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Fletes')

@section('header')
	@section('header_title', 'Creación de Fletes') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/fletes') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	    
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')
    <div class="container">
        <div id="Error"></div>
        <div class="narrow-form">
            <div class="inner">
                <div class="title">
                    <span>Edición de flete</span>
                </div>
                {!! Form::model($flete, [
                    'method' => 'PATCH',
                    'url' => ['/vadmin/fletes', $flete->id],
                    'files' => true
                ]) !!}
                @include('vadmin.fletes.form')
                {!! Form::submit('Actualizar', ['class' => 'button btnGreen']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
	@include('vadmin.components.ajaxscripts')
@endsection


@section('custom_js')
	<script>

        /////////////////////////////////////////////////
        //            LOAD LOCALIDADES                 //
        /////////////////////////////////////////////////



    
    </script>
@endsection