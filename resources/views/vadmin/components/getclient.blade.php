
<div id="GetClientForm" class="big-form">
    <div class="row inner-row">
        {{-- /// --}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('cliente', 'Cliente') !!}
                {!! Form::select('cliente', $clientes, null, ['id' => 'ClienteBySelect', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione un cliente']) !!}
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('codigo', 'Buscar por código') !!}
                {!! Form::text('codigo', null, ['id' => 'CodigoCliente', 'class' => 'form-control']) !!}
            </div>
        </div>
        {{-- /// --}}
        <div id="OutPut" class="Hidden">
            <div class="col-md-12 output-data">
                <div id="ClientNameOutput" class="output-inner"></div>
                <button id="ClientOk" class="btnSm buttonOk"> Ok</button>
            </div>
        </div>
    </div>
</div> 	
