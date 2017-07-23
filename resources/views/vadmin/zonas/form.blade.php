<div class="form-group">
    {!! Form::label('name', 'Zona:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la zona', 'required' => '']) !!} 
</div>
{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk']) !!}
