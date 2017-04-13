@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Clientes')

@section('header')
	@section('header_title', 'Creación de Clientes') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/clientes') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	    
	@endsection
@endsection

@section('styles')
	
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

