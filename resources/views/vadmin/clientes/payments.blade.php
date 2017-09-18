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
        <button id="AddPaymentEBtn" type="submit" class="button btnSmall btnGreen">Ingresar</button>
        {{-- This handles redirect after store payment --}}
        {!! Form::text('redirect', 'vadmin/clientes/cuenta/'.$client->id, ['class' => 'form-control Hidden', 'id' => 'PaymentModo']) !!}
    {!! Form::close() !!}

    {!! Form::open(['route' => 'movimientos.store', 'method' => 'POST', 'id' => 'AddPaymentBForm', 'class' => 'PaymentForms', 'data-parsley-validate' => '']) !!}
        {{-- Banco --}}
        <div class="item-title">
            <b>BANCO</b>
        </div>
        <div class="form-group">
            {{-- {!! Form::label('banco', 'Nombre del Banco:') !!}
            {!! Form::text('banco', null, ['class' => 'form-control']) !!} --}}
            {!! Form::number('cliente_id', $client->id, ['class' => 'form-control Hidden', 'id' => 'ClientId' ]) !!}
            {!! Form::text('modo', 'B', ['class' => 'form-control Hidden']) !!}
            {!! Form::text('op', 'I', ['class' => 'form-control Hidden']) !!}
            {!! Form::label('importe', 'Importe:') !!}
            {!! Form::text('importe', null, ['class' => 'form-control', 'required' => '']) !!}
            {!! Form::label('det1', 'Operación:') !!}
            {!! Form::select('det1', ['Depósito' => 'Depósito', 'Transferencia' => 'Transferencia'], null,  ['class' => 'form-control Select-Chosen']) !!}
            {!! Form::label('comprobante_id', 'Comprobante N°:') !!}
            {!! Form::select('comprobante_id', $comprobantes, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Corresponde a comprobante']) !!}    
        </div>
        <button id="AddPaymentBBtn" type="submit"  class="button btnSmall btnGreen">Ingresar</button>
        {{-- This handles redirect after store payment --}}
        {!! Form::text('redirect', 'vadmin/clientes/cuenta/'.$client->id, ['class' => 'form-control Hidden', 'id' => 'PaymentModo']) !!}
    {!! Form::close() !!}
    {!! Form::open(['route' => 'movimientos.store', 'method' => 'POST', 'id' => 'AddPaymentCForm', 'class' => 'PaymentForms', 'data-parsley-validate' => '']) !!}
        {{-- Cheque --}}
        <div class="item-title">
            <b>CHEQUE</b>
        </div>
        <div class="form-group">
            {!! Form::number('cliente_id', $client->id, ['class' => 'form-control Hidden', 'id' => 'ClientId' ]) !!}
            {!! Form::text('modo', 'C', ['class' => 'form-control Hidden']) !!}
            {!! Form::text('op', 'I', ['class' => 'form-control Hidden']) !!}
            {!! Form::label('importe', 'Importe:') !!}
            {!! Form::text('importe', null, ['class' => 'form-control', 'required' => '']) !!}
            {!! Form::label('det1', 'Nombre del Banco:') !!}
            {!! Form::text('det1', null, ['class' => 'form-control']) !!}
            {!! Form::label('det2', 'Número:') !!}
            {!! Form::text('det2', null, ['class' => 'form-control']) !!}
            {!! Form::label('det3', 'Sucursal:') !!}
            {!! Form::text('det3', null, ['class' => 'form-control']) !!}
            {!! Form::label('det4', 'Fecha de Cobro:') !!}
            {!! Form::text('det4', null, ['class' => 'form-control']) !!}
            {!! Form::label('det5', 'Cuit:') !!}
            {!! Form::text('det5', null, ['class' => 'form-control', 'maxlength' => '11', 'minlength' => '11', 'data-mask'=>'00-00000000-0']) !!}
            {!! Form::label('comprobante_id', 'Comprobante N°:') !!}
            {!! Form::select('comprobante_id', $comprobantes, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Corresponde a comprobante']) !!}    
        </div>
        <button id="AddPaymentCBtn" type="submit" class="button btnSmall btnGreen">Ingresar</button>
        {!! Form::text('redirect', 'vadmin/clientes/cuenta/'.$client->id, ['class' => 'form-control Hidden', 'id' => 'PaymentModo']) !!}
    {!! Form::close() !!}
    {!! Form::open(['route' => 'movimientos.store', 'method' => 'POST', 'id' => 'AddPaymentRForm', 'class' => 'PaymentForms', 'data-parsley-validate' => '']) !!}
        {{-- Retencion --}}
        <div class="item-title">
            <b>RETENCIÓN</b>
        </div>
        <div class="form-group">
            {!! Form::number('cliente_id', $client->id, ['class' => 'form-control Hidden', 'id' => 'ClientId' ]) !!}
            {!! Form::text('modo', 'R', ['class' => 'form-control Hidden']) !!}
            {!! Form::text('op', 'I', ['class' => 'form-control Hidden']) !!}
            {!! Form::label('importe', 'Importe:') !!}
            {!! Form::text('importe', null, ['class' => 'form-control', 'required' => '']) !!}
            {!! Form::label('det1', 'Tipo:') !!}
            {!! Form::select('det1', ['Ganancias' => 'Ganancias', 'Iva' => 'Iva' , 'Ingresos Brutos' => 'Ingresos Brutos', 'SUSS' => 'SUSS', 'Retenciones Varias' => 'Retenciones Varias'], null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione un tipo']) !!}
            {!! Form::label('det2', 'Número:') !!}
            {!! Form::number('det2', null, ['class' => 'form-control']) !!}
            {!! Form::label('det3', 'Jurisdicción:') !!}
            {!! Form::text('det3', null, ['class' => 'form-control']) !!}
            {!! Form::label('comprobante_id', 'Comprobante N°:') !!}
            {!! Form::select('comprobante_id', $comprobantes, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Corresponde a comprobante']) !!}    
        </div>
        <button id="AddPaymentRBtn" type="submit" class="button btnSmall btnGreen">Ingresar</button>
        {!! Form::text('redirect', 'vadmin/clientes/cuenta/'.$client->id, ['class' => 'form-control Hidden', 'id' => 'PaymentModo']) !!}
    {!! Form::close() !!}
</div>

