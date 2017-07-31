<div class="vertical-container">
    <div class="option-buttons">
        <button id="PaymentEBtn" class="btn btnBlue">Efectivo</button>
        <button id="PaymentBBtn" class="btn btnBlue">Banco</button>
        <button id="PaymentCBtn" class="btn btnBlue">Cheque</button>
        <button id="PaymentRBtn" class="btn btnBlue">Retención</button>
    </div>

    {{-- Form Style and Payment Mode are in vadmin_ui.js --}}

    {!! Form::open(['url' => 'vadmin/pagos', 'id' => 'AddPaymentEForm', 'data-parsley-validate' => '']) !!}
        {!! Form::label('factura_id', 'Factura N°:') !!}
        {!! Form::select('factura_id', $facturas, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una factura']) !!}    
        {!! Form::number('cliente_id', $client->id, ['class' => 'form-control Hidden', 'id' => 'ClientId' ]) !!}
        {!! Form::text('modo', 'E', ['class' => 'form-control Hidden', 'id' => 'PaymentModo']) !!}
        <div id="PaymentEDiv" class="PaymentDivs">
            <div class="item-title">
                <b>EFECTIVO</b>
            </div>
        </div>
        {{-- Banco --}}
        <div id="PaymentBDiv" class="PaymentDivs">
            <div class="item-title">
                <b>BANCO</b>
            </div>
            <div class="form-group">
                {{-- {!! Form::label('banco', 'Nombre del Banco:') !!}
                {!! Form::text('banco', null, ['class' => 'form-control']) !!} --}}
                {!! Form::label('bco_movimiento', 'Operación:') !!}
                {!! Form::select('bco_movimiento', ['Depósito' => 'Depósito', 'Transferencia' => 'Transferencia'], null,  ['class' => 'form-control Select-Chosen']) !!}
            </div>
        </div>
        {{-- Cheque --}}
        <div id="PaymentCDiv" class="PaymentDivs">
            <div class="item-title">
                <b>CHEQUE</b>
            </div>
            <div class="form-group">
                {!! Form::label('ch_banco', 'Nombre del Banco:') !!}
                {!! Form::text('ch_banco', null, ['class' => 'form-control']) !!}
                {!! Form::label('ch_banco_nro', 'Número:') !!}
                {!! Form::text('ch_banco_nro', null, ['class' => 'form-control']) !!}
                {!! Form::label('sucursal', 'Sucursal:') !!}
                {!! Form::text('sucursal', null, ['class' => 'form-control']) !!}
                {!! Form::label('ch_fechacobro', 'Fecha de Cobro:') !!}
                {!! Form::text('ch_fechacobro', null, ['class' => 'form-control']) !!}
                {!! Form::label('ch_cuit', 'Cuit:') !!}
                {!! Form::text('ch_cuit', null, ['class' => 'form-control', 'maxlength' => '11', 'minlength' => '11', 'data-mask'=>'00-00000000-0']) !!}
            </div>
        </div>
        {{-- Retencion --}}
        <div id="PaymentRDiv" class="PaymentDivs">
            <div class="item-title">
                <b>RETENCIÓN</b>
            </div>
            <div class="form-group">
                {!! Form::label('ret_tipo', 'Tipo:') !!}
                {!! Form::select('ret_tipo', ['Ganancias' => 'Ganancias', 'Iva' => 'Iva' , 'Ingresos Brutos' => 'Ingresos Brutos', 'SUSS' => 'SUSS', 'Retenciones Varias' => 'Retenciones Varias'], null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione un tipo']) !!}
                {!! Form::label('ret_nro', 'Número:') !!}
                {!! Form::number('ret_nro', null, ['class' => 'form-control']) !!}
                {!! Form::label('ret_jurisdicción', 'Jurisdicción:') !!}
                {!! Form::text('ret_jurisdicción', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        {{-- Valor --}}
        <div class="form-group">
            {!! Form::label('importe', 'Importe:') !!}
            {!! Form::text('importe', null, ['class' => 'form-control']) !!}
        </div>
        <button id="AddPaymentBtn" class="button btnSmall btnGreen">Ingresar</button>
        {{-- This handles redirect after store payment --}}
        {!! Form::text('redirect', 'vadmin/clientes/cuenta/'.$client->id, ['class' => 'form-control Hidden', 'id' => 'PaymentModo']) !!}
    {!! Form::close() !!}
</div>

