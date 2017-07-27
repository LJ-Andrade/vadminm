<div class="form-group">
    {!! Form::label('name', 'Provincia:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la provincia', 'required' => '']) !!} 
</div>
{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk']) !!}
