@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Tipocts')

@section('header')
	@section('header_title', 'Creación de Tipocts') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/tipocts') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

     <div  class="narrow-form">
		<div class="inner">
			<div class="title">
				<span>Creación de tipo de cliente</span>
			</div>
            {!! Form::open(['url' => 'vadmin/tipocts', 'data-parsley-validate' => '']) !!}
                @include ('vadmin.tipocts.form')
            {!! Form::close() !!}
        </div>
    </div>

@endsection
