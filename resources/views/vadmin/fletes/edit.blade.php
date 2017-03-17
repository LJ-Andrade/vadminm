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
        <div class="small-form container animated fadeIn">
            {!! Form::model($flete, [
                'method' => 'PATCH',
                'url' => ['/vadmin/fletes', $flete->id],
                'files' => true
            ]) !!}

            <div class="row inner">
                <div class="col-md-12 title">
                    <span><i class="ion-plus-round"></i> Edición de Item</span>
                    <a href="{{ url('vadminfletes') }}"><div class="close-btn2"><i class="ion-close-round"></i></div></a>
                </div>
                <div class=" col-md-12 form-group">
                    {!! Form::label('name', 'Nombre:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del item', 'required' => '', 'maxlength' => '120', 'minlength' => '4']) !!} 
                </div>
                <div class="col-md-12 actions">
                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Modificar', ['class' => 'animated fadeIn button buttonOk pull-right']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection

