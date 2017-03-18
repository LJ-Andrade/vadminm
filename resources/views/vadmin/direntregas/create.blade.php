@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Direntregas')

@section('header')
	@section('header_title', 'Creación de Direcciones de Entrega') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/direntregas') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

    <div class="container">
        <div class="small-form container animated fadeIn">
            {!! Form::open(['url' => 'vadmin/direntregas', 'data-parsley-validate' => '']) !!}
            <div class="row inner">
                <div class="col-md-12 title">
                    <span><i class="ion-plus-round"></i> Creación de Nuevo Item</span>
                    <a href="{{ url('vadmin/direntregas') }}"><div class="close-btn2"><i class="ion-close-round"></i></div></a>
                </div>
                <div class=" col-md-12 form-group">
                    {!! Form::label('cliente', 'Cliente:') !!}
                    {!! Form::select('cliente', $clientes, null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Cliente', 'required'=>'']) !!} 
                    {!! Form::label('name', 'Dirección:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del item', 'required' => '']) !!} 
                    {!! Form::label('name', 'Provincia:') !!}
                    {!! Form::select('provincia', $provincias, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una provincia', 'required' => '']) !!} 
                    {!! Form::label('localidad', 'Localidad:') !!}
                    {!! Form::select('localidad', $localidades, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una localidad', 'required' => '']) !!} 
                    {!! Form::label('telefono', 'Teléfono:') !!}
                    {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del item', 'required'=>'']) !!} 
                </div>
                <div class="col-md-12 actions">
                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk pull-right']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/mask/mask.min.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
@endsection
