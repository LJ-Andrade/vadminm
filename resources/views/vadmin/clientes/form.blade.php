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
			{!! Form::text('id', $cliente_id->id+1, ['id'=>'Cliente_Id','class' => 'form-control', 'disabled'=>'', 'placeholder' => 'Ingrese el código', 'id'=>'Client_Id']) !!}
			{!! Form::text('id_direntrega', $cliente_id->id+1, ['id'=>'Cliente_Id', 'class' => 'form-control Hidden', 'placeholder' => 'Ingrese el código', 'id'=>'CLIENTID']) !!}
		</div>
	</div>
	{{-- /// --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('razonsocial', 'Razón Social') !!}
			{!! Form::text('razonsocial', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la Razón Social', 'id'=>'RazonSocial']) !!}
		</div>
	</div>
	{{-- /// --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('iva', 'Categoría de IVA') !!}
			{!! Form::select('iva', $iva, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
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
			{!! Form::label('provincia_id', 'Provincia') !!}
			{!! Form::select('provincia_id',  $provincias, null, ['id' => 'ProvinciasAjax', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opción']) !!}
		</div>
	</div>
	{{-- Loc. --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('localidad_id', 'Localidad') !!}
			<select name="localidad_id" id="LocalidadAjax" class="form-control Select-Chosen" required="">
			</select>
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
			{!! Form::select('condicventas', $condicventas, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>
	{{-- Lista de Precios --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('listas', 'Lista de Precios') !!}
			{!! Form::select('listas',  $lista, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>
</div>
<div class="row inner-row">
	{{-- Tipo --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('tipo_id', 'Tipo') !!}
			{!! Form::select('tipo_id', $tipo, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>
	{{-- Descuento --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('descuento', 'Descuento') !!}
			{!! Form::number('descuento', null, ['class' => 'form-control', 'placeholder' => 'Descuento a aplicar...']) !!}
		</div>
	</div>					
	{{-- Vendedor Designado --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('vendedor', 'Vendedor') !!}
			{!! Form::select('vendedor', $users, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>

</div>
<div class="row inner-row">
	{{-- Flete --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('zona', 'Zona') !!}
			{!! Form::select('zona', $zona, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>
	{{-- Flete --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('flete', 'Flete') !!}
			{!! Form::select('flete', $flete, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
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
			{!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un teléfono']) !!}
			</div>
		</div>
	</div>
		{{-- Teléfonos --}}
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="form-group multiple-items">
			{!! Form::label('celular', 'Celular') !!}
			{!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un celular']) !!}
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
{{-- Datos de contacto y entrega --}}
<div class="row sub-title">
	<div class="col-md-12">
		<div class="inner-sub-title"><i class="ion-map icon"></i><span> Direccion de Entrega</span>
			<button type="button" class="OpenDirsEntregaBtn btnSm buttonGrey"><i class="ion-chevron-right"></i></button>
		</div>
	</div>
</div>
<div class="row inner-row">
	{{-- Dirección de Entrega --}}
	<div class="col-md-12 col-sm-6 col-xs-12">							
		<div class="DirsEntregaDiv box-container animated fadeIn clearfix Hidden">
			<div class="CloseDirsEntregaBtn btnCloseDark"><i class="ion-close-round"></i></div>
			<div class="col-md-6 form-group">
				<div class="AnotherAddress">
					{!! Form::label('dirname', 'Calle') !!}
					{!! Form::text('dirname', null, ['class' => 'form-control', 'placeholder' => 'Domicilio de entrega', 'id' => 'DirEntrega']) !!}
					{!! Form::label('dirlocalidad_id', 'Localidad') !!}
					{!! Form::select('dirlocalidad_id',  $localidades, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opcion', 'id' => 'LocEntrega']) !!}
				</div>
			</div>
			<div class="col-md-6 form-group">
				<div class="AnotherAddress">
					{!! Form::label('dirtelefono', 'Teléfono') !!}
					{!! Form::text('dirtelefono', null, ['class' => 'form-control', 'placeholder' => 'Domicilio de entrega', 'id' => 'TelEntrega']) !!}
					{!! Form::label('dirprovincia_id', 'Provincia') !!}
					{!! Form::select('dirprovincia_id',  $provincias, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opcion', 'id' => 'ProvEntrega']) !!}
				</div>
			</div>
			{{-- <button type="button" class="AddDirsEntregaBtn btnSm buttonOk">Agregar Dirección de Entrega</button> --}}
		</div>							
	</div>        
</div>
{{-- Direccion Added By JS --}}
<div class="row">
	<div class="col-md-12">
		<div id="DirEntregaDiv">
	
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
	{!! Form::label('content', 'Notas') !!}
	{!! Form::textarea('content', null, ['class' => 'form-control Textarea-Editor']) !!}
</div>
<hr class="softhr">
<div class="row text-center">
	{!! Form::submit('Ingresar Cliente', ['class' => 'button buttonOk']) !!}
</div>