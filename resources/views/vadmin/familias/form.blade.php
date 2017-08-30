<div class=" col-md-12 form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la familia', 'required' => '', 'maxlength' => '120', 'minlength' => '4']) !!} 
    {!! Form::label('categoria_id', 'Categoría:') !!}
    {!! Form::select('categoria_id', $categorias, null, ['class' => 'form-control', 'placeholder' => 'Seleccione la categoría','required' => '']) !!} 
    {{-- {!! Form::label('proveedor_id', 'Proveedor:') !!}
    {!! Form::select('proveedor_id', $proveedores, null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del proveedor']) !!}  --}}
</div>