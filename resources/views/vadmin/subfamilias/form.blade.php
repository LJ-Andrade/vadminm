<div class=" col-md-12 form-group">
    {!! Form::label('familia_id', 'Familia:') !!}
    {!! Form::select('familia_id', $familias, null, ['class' => 'form-control', 'placeholder' => 'Seleccione la familia','required' => '']) !!} 
    {!! Form::label('nombre', 'Subfamilia:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la subfamilia', 'required' => '']) !!} 
</div>