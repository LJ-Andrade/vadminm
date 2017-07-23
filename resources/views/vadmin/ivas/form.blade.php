	<div class="form-group">
        {!! Form::label('name', 'Nombre:') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoría', 'required' => '']) !!} 
    </div>
    <div class="form-group">
        {!! Form::label('afipcode', 'Código Afip:') !!}
        {!! Form::text('afipcode', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el código de la Afip', 'required' => '']) !!} 
    </div>
    <div class="form-group">
        {!! Form::label('tipofc', 'Tipo de Factura:') !!}
        {!! Form::text('tipofc', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el tipo de factura', 'required' => '']) !!} 
    </div>
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk']) !!}
