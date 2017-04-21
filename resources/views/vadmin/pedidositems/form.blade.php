<div class="form-group {{ $errors->has('producto_id') ? 'has-error' : ''}}">
    {!! Form::label('producto_id', 'Producto Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('producto_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('producto_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('pedido_id') ? 'has-error' : ''}}">
    {!! Form::label('pedido_id', 'Pedido Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('pedido_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('pedido_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cantidad') ? 'has-error' : ''}}">
    {!! Form::label('cantidad', 'Cantidad', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
        {!! $errors->first('cantidad', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('valor') ? 'has-error' : ''}}">
    {!! Form::label('valor', 'Valor', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('valor', null, ['class' => 'form-control']) !!}
        {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
