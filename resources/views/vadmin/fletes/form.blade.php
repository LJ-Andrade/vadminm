<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => '']) !!}
</div>
<div class="form-group">
    {!! Form::label('telefono', 'Teléfono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control', 'required' => '']) !!}
</div>
<div class="form-group">
    {!! Form::label('direccion', 'Dirección:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>
{{-- Provinces --}}
<div class="form-group">
    {!! Form::label('provincia_id', 'Provincia') !!}
    {!! Form::select('provincia_id',  $provincias, null, ['id' => 'ProvinciasAjax', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opción']) !!}
</div>
{{-- Loc. --}}
<div class="form-group">
    {!! Form::label('localidad_id', 'Localidad') !!}
    {!! Form::select('localidad_id', $localidades, null, ['id' => 'LocalidadAjax', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opción']) !!}
</div>

