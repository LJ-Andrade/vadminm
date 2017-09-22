
    <div class="row inner-row">
        {{-- /// --}}
        <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('id', 'Código') !!}
                {!! Form::text('id', $ultproveedor_id->id+1, ['id'=>'Proveedor_Id','class' => 'form-control', 'disabled'=>'', 'placeholder' => 'Ingrese el código', 'id'=>'Client_Id']) !!}
            </div>
        </div>
        {{-- /// --}}
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('razonsocial', 'Razón Social') !!}
                {!! Form::text('razonsocial', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la Razón Social', 'id'=>'RazonSocial', 'required' => '']) !!}
            </div>
        </div>
        {{-- /// --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('nombre', 'Nombre') !!}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre']) !!}
            </div>
        </div>
        {{-- /// --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('iva', 'Categoría de IVA') !!}
                {!! Form::select('iva', $iva, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
            </div>
        </div>
    </div>

    <div class="row inner-row">
        {{-- Categoría Iva --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('cuit', 'N° de CUIT') !!}
                {!! Form::text('cuit', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el CUIT', 'value'=>'', 'maxlength' => '11', 'minlength' => '11', 'data-mask'=>'00-00000000-0']) !!}
            </div>
        </div>
        {{-- Ing. Brutos --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('ingbrutos', 'Ingresos Brutos') !!}
                {!! Form::text('ingbrutos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Ingresos Brutos']) !!}
            </div>
        </div>
        {{-- Telefonos --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('telefonos', 'Teléfonos') !!}
                {!! Form::text('telefonos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese los teléfonos']) !!}
            </div>
        </div>
        {{-- Email --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('email', 'E-Mail') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el email']) !!}
            </div>
        </div>

    </div>
    <div class="row inner-row">
        {{-- Email --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('direccion', 'Dirección Fiscal') !!}
                {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Dirección Fiscal']) !!}
            </div>
        </div>
        {{-- Provincia --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('provincia', 'Provincia') !!}
                {!! Form::select('provincia',  $provincias, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
            </div>
        </div>
        {{-- Loc. --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('localidad', 'Localidad') !!}
                {!! Form::select('localidad',  $localidades, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
            </div>
        </div>
        {{-- Postal Code --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('codpostal', 'Cod. Postal') !!}
                {!! Form::text('codpostal', null, ['class' => 'form-control', 'placeholder' => 'Código Postal']) !!}
            </div>
        </div>
    </div>
    

    <div class="row">
    {{-- Postal Code --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('pais', 'País:') !!}
                {!! Form::text('pais', 'Argentina', ['class' => 'form-control', 'placeholder' => 'Ingrese el país']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container">
            <hr class="softhr">
            <button type="button" class="ShowNotesTextArea btnSm buttonOther">Agregar Notas</button>
        </div>
    </div>
    {{-- Content --}}
    <div class="form-group animated fadeIn NotesTextArea Hidden">
        {!! Form::label('notas', 'Notas') !!}
        {!! Form::textarea('notas', null, ['class' => 'form-control Textarea-Editor']) !!}
    </div>
    <hr class="softhr">
    <div class="row text-center">
        {!! Form::submit('Ingresar Proveedor', ['class' => 'button buttonOk']) !!}
    </div>
