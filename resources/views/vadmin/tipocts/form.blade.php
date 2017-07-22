<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el tipo de cliente', 'required' => '', 'maxlength' => '120', 'minlength' => '4']) !!} 
</div>
    <div class="col-md-12 actions">
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk']) !!}
</div>

