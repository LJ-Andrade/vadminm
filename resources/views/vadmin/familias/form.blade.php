<div class=" col-md-12 form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la familia', 'required' => '', 'maxlength' => '120', 'minlength' => '4']) !!} 
    {{-- {!! Form::label('proveedor_id', 'Proveedor:') !!}
    {!! Form::select('proveedor_id', $proveedores, null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del proveedor']) !!}  --}}
</div>