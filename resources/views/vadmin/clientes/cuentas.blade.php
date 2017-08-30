@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Mataderos Distribuciones')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Cuentas Corrientes') 
	@section('options')
		<div class="actions">
         
		</div>	
	@endsection
@endsection

@section('styles')
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}
@endsection


@section('content')
<div class="container">
	<div class="col-md-6 medium-card">
        <div class="inner light-grey-back">
            <div class="col-md-12 title">
                <span><b>Cuentas Corrientes</b></span>
            </div>

            <div class="form-group col-md-7">
                {{-- Search By Name --}}
                {!! Form::label('cliente', 'Buscar por nombre') !!}
                {!! Form::text('cliente', null, ['id' => 'ClientAutoComplete', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-5">
                {{-- Search By Code  --}}
                {!! Form::label('codigo', 'Buscar por código') !!}
                {!! Form::number('codigo', null, ['id' => 'ClientByCode', 'class' => 'form-control', 'min' => '2']) !!}
            </div>
            <div class="col-md-12">
                <button id="ClientByCodeBtn" class="btnSm btnBlue"> Buscar</button>	
            </div>
            <div id="ClientOutPut" class="col-md-12 Hidden">
                <div class="output-box inner-grey-back">
                    <h4><b>Cliente seleccionado:</b></h4>
                    <div id="ClientData"></div>
                    <div id="OutPutForm">
                        {!! Form::open(['url' => '', 'method' => 'POST', 'id' => 'GoToAccountForm']) !!}
                            <div class="col-md-12">
                                <input type="text" name="user_id" class="Hidden" value="{{ Auth::user()->id }}">
                            </div>
                            {!! Form::text('cliente_id', null, ['id' => 'ClienteIdOutput', 'class' => 'form-control Hidden', 'required' => '']) !!} 
                            
                            <button id="GoToAccount" class="button buttonOk"> Ver Cuenta</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            
        </div>
    </div> 
</div>
@endsection
