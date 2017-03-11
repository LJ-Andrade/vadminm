<div id="NewFormContainer" class="form-div container animated fadeIn Hidden">
	<div class="row">

        {!! Form::open(['id'=>'NewForm', 'data-parsley-validate' => '']) !!}
            <div class="col-md-12 title">
                <span><i class="ion-plus-round"></i> Creación de Nuevo 2323</span>
            </div>
            <div class="form-group col-md-12">
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
            <div class="FormError"></div>
            <div class="col-md-12 actions">
                {!! Form::submit('Crear Usuario', ['id' => 'NewBtn', 'class' => 'animated fadeIn button buttonOk pull-right']) !!}
                <button class="CloseFormBtn animated fadeIn button buttonCancel pull-right">Cerrar</button>
            </div>
        {!! Form::close() !!}

	</div>
</div>


<div id="EditFormContainer" class="form-div container animated fadeIn Hidden">
	<div class="row">

        {!! Form::open(['id'=>'EditForm', 'data-parsley-validate' => '']) !!}
            <div class="col-md-12 title">
                <span><i class="ion-edit"></i> Edición de Usuario: </span><b><span id="EditTitle"></span></b>
            </div>
            <div class="form-group col-md-12">
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
                    {!! Form::label('password', 'Contraseña:') !!} <br>
                    <button class="ShowPassInputBtn btnSmall buttonEdit">Cambiar Contraseña</button>
                    <div class="PasswordSlot"></div>
                </div>
            </div>
            <div class="FormError"></div>
            <div class="col-md-12 actions">
                {!! Form::submit('Editar Usuario', ['id' => 'EditBtn', 'class' => 'animated fadeIn button buttonOk pull-right']) !!}
                <button class="CloseFormBtn animated fadeIn button buttonCancel pull-right">Cerrar</button>
            </div>
        {!! Form::close() !!}

	</div>
</div>
