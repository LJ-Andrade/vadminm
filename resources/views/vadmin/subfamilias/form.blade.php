<div class="col-md-12 form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la subfamilia', 'required' => '']) !!} 
    {!! Form::label('familia_id', 'Familia:') !!}
    {!! Form::select('familia_id', $familias, null, ['class' => 'form-control', 'placeholder' => 'Pertenece a la familia','required' => '']) !!} 
</div>