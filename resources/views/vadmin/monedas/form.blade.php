
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese de la moneda', 'required' => '']) !!} 
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::number('valor', null, ['step'=>'any', 'class' => 'form-control', 'placeholder' => 'Ingrese el valor', 'required' => '']) !!} 
</div>

