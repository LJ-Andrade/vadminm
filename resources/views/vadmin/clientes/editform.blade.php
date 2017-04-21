{{-- //---------------Datos Principales---------------// --}}
{{-- SubTitle --}}
<div class="row sub-title"><div class="col-md-12">
	<div class="inner-sub-title"><i class="ion-clipboard icon"></i><span> Datos Principales</span></div>
</div></div>
<div class="row inner-row">
	{{-- /// --}}
	<div class="col-md-2 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('id', 'Código') !!}
			{!! Form::text('id', $cliente->id, ['id'=>'Cliente_Id','class' => 'form-control', 'disabled'=>'', 'placeholder' => 'Ingrese el código', 'id'=>'Client_Id']) !!}
			
		</div>
	</div>
	{{-- /// --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('razonsocial', 'Razón Social') !!}
			{!! Form::text('razonsocial', $cliente->razonsocial, ['class' => 'form-control', 'placeholder' => 'Ingrese la Razón Social', 'id'=>'RazonSocial']) !!}
		</div>
	</div>
	{{-- /// --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('iva_id', 'Categoría de IVA') !!}
			{!! Form::select('iva_id', $iva, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>
		{{-- /// --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('cuit', 'N° de CUIT') !!}
			{!! Form::text('cuit', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el CUIT',]) !!}
		</div>
	</div>
</div>

<div class="row inner-row">
	{{-- Dirección --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('dirfiscal', 'Dirección Fiscal') !!}
			{!! Form::text('dirfiscal', null, ['class' => 'form-control', 'placeholder' => 'Dirección Fiscal']) !!}
		</div>
	</div>
	{{-- Provinces --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('provincia', 'Provincia') !!}
			{!! Form::select('provincia',  $provincias, $cliente->provincia_id, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>
	{{-- Loc. --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('localidad', 'Localidad') !!}
			{!! Form::select('localidad',  $localidades, $cliente->localidad_id, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
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

{{-- //------------------ Ventas ----------------// --}}
{{-- SubTitle --}}
<div class="row sub-title"><div class="col-md-12">
	<div class="inner-sub-title"><i class="ion-ios-calculator-outline icon"></i><span> Ventas</span></div>
</div></div>
<div class="row inner-row">
	{{-- Limite de credito --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('limitcred', 'Límite de Crédito') !!}
			{!! Form::text('limitcred', null, ['class' => 'form-control', 'placeholder' => 'Ingrese límite']) !!}
		</div>
	</div>
	{{-- Condicion de venta --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('condicventas', 'Condiciones de Vta.') !!}
			{!! Form::select('condicventas', $condicventas, $cliente->condicventas_id, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>
	{{-- Lista de Precios --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('listas', 'Lista de Precios') !!}
			{!! Form::select('listas', $lista, $cliente->listas_id, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>
</div>
<div class="row inner-row">
	{{-- Tipo --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('tipo', 'Tipo') !!}
			{!! Form::select('tipo', $tipo, $cliente->tipo, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>
	{{-- Descuento --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('descuento', 'Descuento') !!}
			{!! Form::text('descuento', null, ['class' => 'form-control', 'placeholder' => 'Descuento a aplicar...']) !!}
		</div>
	</div>					
	{{-- Vendedor Designado --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('vendedor', 'Vendedor') !!}
			{!! Form::select('vendedor', $users, $cliente->user_id, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>

</div>
<div class="row inner-row">
	{{-- Flete --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('zona', 'Zona') !!}
			{!! Form::select('zona', $zona, $cliente->zona_id, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>
	{{-- Flete --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('flete', 'Flete') !!}
			{!! Form::select('flete', $flete, $cliente->flete_id, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>
</div>
	{{-- //-------------------------------------------------// --}}
{{-- Datos de contacto y entrega --}}
<div class="row sub-title"><div class="col-md-12">
	<div class="inner-sub-title"><i class="ion-paper-airplane icon"></i><span> Datos de contacto</span></div>
</div></div>
<div class="row inner-row">
	{{-- Teléfonos --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group multiple-items">
			{!! Form::label('telefonos', 'Teléfonos') !!}
			<div class="TelInputs">
			{!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un teléfono', 'data-mask'=>'0000-0000 | 0000-0000 | 0000-0000']) !!}
			</div>
			{{--<div class="AddAnother add-another"><button type="button" class="AddAnotherTelBtn transBtn">
				<i class="ion-ios-plus-outline"></i> Agregar otro teléfono</button>
			</div>--}}
		</div>
	</div>
		{{-- Teléfonos --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group multiple-items">
			{!! Form::label('celular', 'Celular') !!}
			{!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un celular', 'data-mask'=>'(00)0000-0000 | (00)0000-0000 | (00)0000-0000']) !!}
		</div>
	</div>
	{{-- E-Mail --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group multiple-items">
			{!! Form::label('email', 'E-Mail') !!}
			{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un E-mail']) !!}
		</div>
	</div>
</div>
{{-- //-------------------------------------------------// --}}
{{-- Content --}}
<div class="form-group animated fadeIn NotesTextArea Hidden">
	{!! Form::label('content', 'Notas') !!}
	{!! Form::textarea('content', null, ['class' => 'form-control Textarea-Editor']) !!}
</div>
<hr class="softhr">
<div class="row text-center">
	{!! Form::submit('Editar Cliente', ['class' => 'button buttonOk']) !!}
</div>