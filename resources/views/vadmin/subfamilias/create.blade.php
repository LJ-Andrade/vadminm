@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Subfamilias')

@section('header')
	@section('header_title', 'Subfamilias') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/subfamilias') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

    <div class="container">
        <div class="small-form container animated fadeIn">
            {!! Form::open(['url' => 'vadmin/subfamilias', 'data-parsley-validate' => '']) !!}
            <div class="row inner">
                <div class="col-md-12 title">
                    <span><i class="ion-plus-round"></i> Creación de Subfamilia</span>
                    <a href="{{ url('vadmin/subfamilias') }}"><div class="close-btn2"><i class="ion-close-round"></i></div></a>
                </div>
                <div class=" col-md-12 form-group">
                    {!! Form::label('familia_id', 'Familia:') !!}
                    {!! Form::select('familia_id', $familias, null, ['class' => 'form-control', 'placeholder' => 'Seleccione la familia','required' => '']) !!} 
                    {!! Form::label('nombre', 'Subfamilia:') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la subfamilia', 'required' => '']) !!} 
                </div>
                <div class="col-md-12 actions">
                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk pull-right']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
