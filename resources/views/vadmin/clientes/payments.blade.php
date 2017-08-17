<div class="vertical-container">
    <div class="option-buttons">
        <button id="PaymentEBtn" class="btn btnBlue">Efectivo</button>
        <button id="PaymentBBtn" class="btn btnBlue">Banco</button>
        <button id="PaymentCBtn" class="btn btnBlue">Cheque</button>
        <button id="PaymentRBtn" class="btn btnBlue">Retención</button>
    </div>

    {{-- Form Style and Payment Mode are in vadmin_ui.js --}}

    {!! Form::open(['route' => 'movimientos.store', 'method' => 'POST', 'id' => 'AddPaymentEForm', 'class' => 'PaymentForms', 'data-parsley-validate' => '']) !!}
        <div class="item-title">
            <b>EFECTIVO</b>
        </div>
        {{-- Valor --}}
        <div class="form-group">
            {!! Form::number('cliente_id', $client->id, ['class' => 'form-control Hidden', 'id' => 'ClientId' ]) !!}
            {!! Form::text('modo', 'E', ['class' => 'form-control Hidden']) !!}
            {!! Form::text('op', 'I', ['class' => 'form-control Hidden']) !!}
            {!! Form::label('importe', 'Importe:') !!}
            {!! Form::text('importe', null, ['class' => 'form-control', 'required' => '']) !!}
            {!! Form::label('comprobante_id', 'Comprobante N°:') !!}
            {!! Form::select('comprobante_id', $comprobantes, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Corresponde a comprobante']) !!}    
        </div>
        <button id="AddPaymentEBtn" type="submit" class="button btnSmall btnGreen">Ingresar E</button>
        {{-- This handles redirect after store payment --}}
        {!! Form::text('redirect', 'vadmin/clientes/cuenta/'.$client->id, ['class' => 'form-control Hidden', 'id' => 'PaymentModo']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => 'vadmin/pagos', 'id' => 'AddPaymentBForm', 'class' => 'PaymentForms', 'data-parsley-validate' => '']) !!}
        {{-- Banco --}}
        <div class="item-title">
            <b>BANCO</b>
        </div>
        <div class="form-group">
            {{-- {!! Form::label('banco', 'Nombre del Banco:') !!}
            {!! Form::text('banco', null, ['class' => 'form-control']) !!} --}}
            {!! Form::label('bco_movimiento', 'Operación:') !!}
            {!! Form::select('bco_movimiento', ['Depósito' => 'Depósito', 'Transferencia' => 'Transferencia'], null,  ['class' => 'form-control Select-Chosen']) !!}
            {!! Form::label('comprobante_id', 'Comprobante N°:') !!}
            {!! Form::select('comprobante_id', $comprobantes, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Corresponde a comprobante']) !!}    
        </div>
        <button id="AddPaymentBBtn" class="button btnSmall btnGreen">Ingresar B</button>
        {{-- This handles redirect after store payment --}}
        {!! Form::text('redirect', 'vadmin/clientes/cuenta/'.$client->id, ['class' => 'form-control Hidden', 'id' => 'PaymentModo']) !!}
    {!! Form::close() !!}
    {!! Form::open(['url' => 'vadmin/pagos', 'id' => 'AddPaymentCForm', 'class' => 'PaymentForms', 'data-parsley-validate' => '']) !!}
        {{-- Cheque --}}
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
            {!! Form::label('comprobante_id', 'Comprobante N°:') !!}
            {!! Form::select('comprobante_id', $comprobantes, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Corresponde a comprobante']) !!}    
        </div>
        <button id="AddPaymentCBtn" class="button btnSmall btnGreen">Ingresar C</button>
    {!! Form::close() !!}
    {!! Form::open(['url' => 'vadmin/pagos', 'id' => 'AddPaymentRForm', 'class' => 'PaymentForms', 'data-parsley-validate' => '']) !!}
        {{-- Retencion --}}
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
            {!! Form::label('comprobante_id', 'Comprobante N°:') !!}
            {!! Form::select('comprobante_id', $comprobantes, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Corresponde a comprobante']) !!}    
        </div>
        <button id="AddPaymentRBtn" class="button btnSmall btnGreen">Ingresar R</button>
    {!! Form::close() !!}
</div>

