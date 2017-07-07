@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Pagos')

@section('header')
	@section('header_title', 'Creación de Pagos') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/pagos') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

    <div class="container">
        <div id="ClientFinder" class="narrow-form">
            <div class="inner">
                {{-- Title --}}
                <div class="title">
                    <span>INGRESAR UN PAGO</span>
                </div>
                {{-- By Name Search --}}
                <div class="form-group">
                    {!! Form::label('cliente', 'Buscar por nombre') !!}
                    {!! Form::text('cliente', null, ['id' => 'ClientAutoComplete', 'class' => 'form-control']) !!}
                </div>
                {{-- By Code Search --}}
                <div class="form-group">
                    {!! Form::label('codigo', 'Buscar por código') !!}
                    {!! Form::number('codigo', null, ['id' => 'ClientByCode', 'class' => 'form-control']) !!}
                    <button id="ClientByCodeBtn" class="btnSm btnBlue"> Buscar</button>
                </div>
            
                {{-- Output --}}
                <div id="SmallLoader"></div>
                <div id="ClientOutPut" class="Hidden">
                    <div class="output-box">
                        <h4>Cliente seleccionado:</h4>
                        <div id="ClientData"></div>
                        <div id="OutPutForm">
                            {!! Form::open(['method' => 'POST', 'id' => 'NewItemForm']) !!}
                                <div class="col-md-12">
                                    <input type="text" name="user_id" class="Hidden" value="{{ Auth::user()->id }}">
                                </div>
                                {!! Form::text('cliente_id', null, ['id' => 'ClienteIdOutput', 'class' => 'form-control Hidden', 'required' => '']) !!} 
                                <br>
                                <button id="OpenPaymentBtn" class="button btnSm btnGreen"> Efectivo</button>
                                <button id="OpenPaymentBtn" class="button btnSm btnBlue"> Banco</button>
                                <button id="OpenPaymentBtn" class="button btnSm btnYellow"> Cheque</button>
                                <button id="OpenPaymentBtn" class="button btnSm btnRed"> Retención</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div id="ClientError" class="output-box Hidden">
                    El cliente no existe
                </div>
            </div>
        </div>


        <div id="NewPayment" class="narrow-form Hidde">
            <div class="inner">
                <div class="title">
                    <span>INGRESAR PAGO</span>
                </div>
                <br>
                <b>Cliente: </b> <span id="ClientName"></span><br>
                <b>Cód: </b><span id="ClientCode"></span>
                <div class="form-group">
                    {!! Form::label('modo', 'Modo de Pago') !!}
                    <select name="" class="form-control Select-Chosen">
                        <option value="0" selected disabled>Seleccione una opción...</option>
                        <option value="1">Efectivo</option>
                        <option value="2">Cheque</option>
                        <option value="3">Banco</option>
                        <option value="4">Retencion</option>

                    </select>
                    

                    {!! Form::label('cliente', 'Buscar por nombre') !!}
                    {!! Form::text('codigo', null, ['id' => 'ClientAutoComplete', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>



    </div> {{-- Container --}}

@endsection


@section('scripts')
	{{-- <script type="text/javascript" src="{{ asset('plugins/texteditor/trumbowyg.min.js')}} "></script> --}}
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/mask/mask.min.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('plugins/jqueryUi/jquery-ui.min.js')}} "></script>
	@include('vadmin.components.ajaxscripts')
	@include('vadmin.pagos.scripts')
@endsection