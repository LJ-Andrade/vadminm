<div class="row inner-row">
	{{-- /// --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('cliente', 'Cliente') !!}
			{!! Form::select('cliente', $clientes, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>

	{{-- /// --}}
	<div class="col-md-2 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('razonsocial', 'Razón Social') !!}
			{!! Form::text('razonsocial', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la Razón Social', 'id'=>'RazonSocial']) !!}
		</div>
	</div>
	{{-- /// --}}
	<div class="col-md-2 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('iva', 'Categoría de IVA') !!}
			
		</div>
	</div>
		{{-- /// --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('cuit', 'N° de CUIT') !!}
			{!! Form::text('cuit', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el CUIT', 'value'=>'', 'maxlength' => '11', 'minlength' => '11', 'data-mask'=>'00-00000000-0']) !!}
		</div>
	</div>
</div>
{{-- Content --}}
<div class="form-group animated fadeIn NotesTextArea Hidden">
	{!! Form::label('content', 'Notas') !!}
	{!! Form::textarea('content', null, ['class' => 'form-control Textarea-Editor']) !!}
</div>
<hr class="softhr">
<div class="row text-center">
	{!! Form::submit('Ingresar Cliente', ['class' => 'button buttonOk']) !!}
</div>