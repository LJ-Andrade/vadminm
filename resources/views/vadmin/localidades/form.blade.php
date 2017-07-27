<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la localidad', 'required' => '']) !!} 
</div>

<div class="form-group">
    {!! Form::label('province_id', 'Provincia:') !!}
    {!! Form::select('province_id', $provincias, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Ingrese la provincia']) !!} 
</div>

