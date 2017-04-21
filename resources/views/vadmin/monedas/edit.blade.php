@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Monedas')

@section('header')
	@section('header_title', 'Creación de Monedas') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/monedas') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	    
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')
    <div class="container">
        <div class="small-form container animated fadeIn">
            {!! Form::model($moneda, [
                'method' => 'PATCH',
                'url' => ['/vadmin/monedas', $moneda->id],
                'files' => true
            ]) !!}

            <div class="row inner">
                <div class="col-md-12 title">
                    <span><i class="ion-plus-round"></i> Edición de Item</span>
                    <a href="{{ url('vadmin/monedas') }}"><div class="close-btn2"><i class="ion-close-round"></i></div></a>
                </div>
                <div class=" col-md-12 form-group">
                    {!! Form::label('valor', 'Valor actual:') !!}
                    {!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el valor de la moneda', 'required' => '']) !!} 
                </div>
                <div class="col-md-12 actions">
                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Modificar', ['class' => 'animated fadeIn button buttonOk pull-right']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection

