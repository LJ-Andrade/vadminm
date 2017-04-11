@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Familias')

@section('header')
	@section('header_title', 'Familias') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/familias') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	    
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')
    <div class="container">
        <div class="small-form container animated fadeIn">
            {!! Form::model($familia, [
                'method' => 'PATCH',
                'url' => ['/vadmin/familias', $familia->id],
                'files' => true
            ]) !!}

            <div class="row inner">
                <div class="col-md-12 title">
                    <span><i class="ion-plus-round"></i> Edición de Familia</span>
                    <a href="{{ url('vadmin/familias') }}"><div class="close-btn2"><i class="ion-close-round"></i></div></a>
                </div>
                <div class=" col-md-12 form-group">
                    {!! Form::label('nombre', 'Nombre:') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del item', 'required' => '', 'maxlength' => '120', 'minlength' => '4']) !!} 
                </div>
                <div class="col-md-12 actions">
                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Modificar', ['class' => 'animated fadeIn button buttonOk pull-right']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection

