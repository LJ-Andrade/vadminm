@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Localidades')

@section('header')
	@section('header_title', 'Creación de Localidad') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/localidades') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

    <div class="container">
        <div class="small-form container animated fadeIn">
            {!! Form::open(['url' => 'vadmin/localidades', 'data-parsley-validate' => '']) !!}
            <div class="row inner">
                <div class="col-md-12 title">
                    <span><i class="ion-plus-round"></i> Creación de Nuevo Item</span>
                    <a href="{{ url('vadmin/localidades') }}"><div class="close-btn2"><i class="ion-close-round"></i></div></a>
                </div>
                <div class=" col-md-12 form-group">
                    {!! Form::label('name', 'Nombre:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del item', 'required' => '', 'maxlength' => '120', 'minlength' => '4']) !!} 
                </div>
                <div class="col-md-12 actions">
                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'animated fadeIn button buttonOk pull-right']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
