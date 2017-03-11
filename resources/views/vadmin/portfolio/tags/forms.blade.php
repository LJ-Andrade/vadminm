<div id="NewFormContainer" class="small-form container animated fadeIn Hidden">
    {!! Form::open(['id'=>'NewForm', 'data-parsley-validate' => '']) !!}
        <div class="row inner">
            <div class="col-md-12 title">
                <span><i class="ion-plus-round"></i> Creación de nuevo Tag</span>
                <div class="CloseSmallForm close-btn"><i class="ion-close-round"></i></div>		
            </div>
            <div class=" col-md-12 form-group">
                {!! Form::label('name', 'Nombre:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del tag', 'required' => '', 'maxlength' => '120', 'minlength' => '4']) !!}
            </div>
            {{-- Error --}}
            <div class="col-md-12 error-container">
                <div class="FormNewError error-content Hidden"></div>
            </div>
            {{-- Action --}}
            <div class="col-md-12 actions">
                {!! Form::submit('Crear Tag', ['id' => 'NewBtn', 'class' => 'animated fadeIn button buttonOk pull-right']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>

<div id="EditFormContainer" class="small-form container animated fadeIn Hidden">
    {!! Form::open(['id'=>'EditForm', 'data-parsley-validate' => '']) !!}
        <div class="row inner">
            <div class="col-md-12 title">
                <span><i class="ion-edit"></i> Editando Tag: </span><b><span id="EditTitle"></span></b>
                <div class="CloseSmallForm close-btn"><i class="ion-close-round"></i></div>		
            </div>
            <div class="col-md-12 form-group">
                {!! Form::text('id', null, ['id' => 'EditId', 'class' => 'Hidden']) !!}
                {!! Form::label('name', 'Nombre:') !!}
                {!! Form::text('name', null, ['id' => 'EditName', 'class' => 'form-control', 'placeholder' => 'Nombre del tag', 'required' => '', 'maxlength' => '120', 'minlength' => '4']) !!}
            </div>
            {{-- Error --}}
            <div class="col-md-12 error-container ">
                <div class="FormEditError error-content Hidden"></div>
            </div>
            {{-- Action --}}
            <div class="col-md-12 actions">
                    {!! Form::submit('Editar Tag', ['id' => 'EditBtn', 'class' => 'animated fadeIn button buttonOk pull-right']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>
