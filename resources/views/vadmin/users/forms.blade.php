<div id="NewFormContainer" class="small-form container animated fadeIn Hidden">
    {!! Form::open(['id'=>'NewForm', 'data-parsley-validate' => '']) !!}
     <div class="row inner">
        <div class="col-md-12 title">
            <div class="CloseSmallForm close-btn"><i class="ion-close-round"></i></div>		
            <span><i class="ion-plus-round"></i> Creación de Nuevo Usuario</span>
        </div>
        <div class=" col-md-12 form-group">
            <div class="col-md-6">
                {!! Form::label('name', 'Nombre:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del usuario', 'required' => '', 'maxlength' => '120', 'minlength' => '4']) !!}
                {!! Form::label('email', 'Email:') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su email', 'required' => '']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('password', 'Contraseña:') !!}
                <input class="form-control" name="password" type="password" value="" required="">
                {!! Form::label('type', 'Rol:') !!}
                {!! Form::select('type', ['user' => 'Usuario','admin' => 'Admin', 'superadmin' => 'SuperAdmin'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opcion', 'required' => '']) !!}
            </div>
        </div>
            {{-- Error --}}
        <div class="col-md-12 error-container">
            <div class="FormNewError error-content Hidden"></div>
        </div>
        <div class="col-md-12 actions">
            {!! Form::submit('Crear Usuario', ['id' => 'NewBtn', 'class' => 'animated fadeIn button buttonOk pull-right']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>


<div id="EditFormContainer" class="small-form container animated fadeIn Hidden">
    {!! Form::open(['id'=>'EditForm', 'data-parsley-validate' => '']) !!}
        <div class="row inner">
            <div class="col-md-12 title">
                <span><i class="ion-edit"></i> Edición de Usuario: </span><b><span id="EditTitle"></span></b>
                 <div class="CloseSmallForm close-btn"><i class="ion-close-round"></i></div>		
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-6">
                    {!! Form::text('id', null, ['id' => 'EditId', 'class' => 'Hidden']) !!}
                    {!! Form::label('name', 'Nombre:') !!}
                    {!! Form::text('name', null, ['id' => 'EditName', 'class' => 'form-control', 'placeholder' => 'Ingrese el nombre del usuario', 'required' => '', 'maxlength' => '120', 'minlength' => '4']) !!}
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::text('email', null, ['id' => 'EditEmail', 'class' => 'form-control', 'placeholder' => 'Ingrese su email', 'required' => '']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('type', 'Rol:') !!}
                    {!! Form::select('type', ['user' => 'Usuario','admin' => 'Admin', 'superadmin' => 'SuperAdmin'], null, ['id' => 'EditRole', 'class' => 'form-control', 'placeholder' => 'Seleccione una opcion', 'required' => '']) !!}
                </div>
            </div>
            {{-- Error --}}
            <div class="col-md-12 error-container">
                <div class="FormNewError error-content Hidden"></div>
            </div>
            <div class="col-md-12 actions">
                {!! Form::submit('Editar Usuario', ['id' => 'EditBtn', 'class' => 'animated fadeIn button buttonOk pull-right']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>