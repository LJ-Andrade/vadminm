{{-- //---------------Datos Principales---------------// --}}
{{-- SubTitle --}}
<div class="row sub-title"><div class="col-md-12">
	<div class="inner-sub-title"><i class="ion-clipboard icon"></i><span> Datos Principales</span></div>
</div></div>

<div class="row inner-row">
	{{-- /// --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('nombre', 'Descripción') !!}
			{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la descripción', 'required' => '']) !!}
		</div>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('categoria_id', 'Categoria') !!}
			{!! Form::select('categoria_id', $categorias, null, ['id' => 'CategoriasSelect', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opción', 'required' => '']) !!}
		</div>
	</div>
	{{-- /// --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('familia_id', 'Familia') !!}
			{!! Form::select('familia_id', $familias, null, ['id' => 'FamiliasSelect', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opción', 'required' => '']) !!}
		</div>
	</div>
	{{-- /// --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('subfamilia_id', 'Subfamilia') !!}
			<select name="subfamilia_id" id="SubfamiliasSelect" class="form-control Select-Chosen" required="">
			</select>
		{{-- 	{!! Form::select('subfamilia_id', $subfamilias, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opción']) !!} --}}
		</div>
	</div>

	
</div>
<div class="row inner-row">
	
	{{-- /// --}}
	@if($producto_id)
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('id', 'Código:') !!}	
			{!! Form::text('id', $producto_id->id+1, ['class' => 'form-control', 'disabled' => '', 'required' => '']) !!}
		</div>
	</div>
	@else
	@endif
	{{-- /// --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('proveedor_id', 'Proveedor') !!}
			{!! Form::select('proveedor_id', $proveedor, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
		</div>
	</div>
	{{-- /// --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('codproveedor', 'Código de Proveedor') !!}
			{!! Form::text('codproveedor', null, ['class' => 'form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	{{-- /// --}}
	
</div>

{{-- /// Precios /// --}}
<div class="row sub-title">
	<div class="col-md-12">
		<div class="inner-sub-title">
			<i class="ion-social-usd icon"></i><span> Valores</span>
		</div>
	</div>
</div>
<div class="row inner-row">
	<div class="col-md-3">
		{{-- Precio de Costo --}}
		<div class="form-group">
			{!! Form::label('costo', 'Precio de Costo') !!}
				
			@if($currency == 1)
				{!! Form::number('costopesos', null, ['id' => 'PrecioCostoIpt', 'class' => 'form-control',  'step'=>'any', 'min' => '0', 'placeholder' => '', 'required' => '']) !!}
			@elseif ($currency == 2)
				{!! Form::number('costodolar', null, ['id' => 'PrecioCostoIpt', 'class' => 'form-control',  'step'=>'any', 'min' => '0', 'placeholder' => '', 'required' => '']) !!}
			@elseif ($currency == 3)
				{!! Form::number('costoeuro', null, ['id' => 'PrecioCostoIpt', 'class' => 'form-control',  'step'=>'any', 'min' => '0', 'placeholder' => '', 'required' => '']) !!}
			@else
				{!! Form::number('costo', null, ['id' => 'PrecioCostoIpt', 'class' => 'form-control',  'step'=>'any', 'min' => '0', 'placeholder' => '', 'required' => '']) !!}
			@endif
		</div>
		{{-- Moneda --}}
		<div class="form-group">
			{!! Form::label('monedacompra', 'Moneda') !!}
			{!! Form::select('monedacompra', $monedas, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion', 'required' => '']) !!}
		</div>
		{{-- Condicion Iva --}}
		<div class="form-group">
			{!! Form::label('condiva', 'Impuesto') !!}
			{!! Form::select('condiva', ['21' => '21 %', '10.5' => '10.5 %'], null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion', 'required' => '']) !!}
		</div>
	</div>		
	<div class="col-md-3">
		{{-- Precio al Gremio --}}
		<div class="form-group form-inline">
			{!! Form::label('pjegremio', '% Gremio') !!}
			<div class="horiz-double-input">
				{!! Form::text('pjegremio', null, ['id'=>'PjeGremioIpt', 'class' => 'form-control input1', 'required' => '']) !!}
				{!! Form::text('preciogremio', null, ['id' => 'PrecioGremioDisp', 'class' => 'form-control input2', 'disabled' => '' ]) !!}
			</div>
		</div> 
		{{-- Precio Particular --}}
		<div class="form-group form-inline">
			{!! Form::label('pjeparticular', '% Particular') !!}
			<div class="horiz-double-input">
				{!! Form::text('precioparticular', null, ['id' => 'PrecioParticularDisp', 'class' => 'form-control input2', 'disabled' => '']) !!}
				{!! Form::text('pjeparticular', null, ['id'=>'PjeParticularIpt', 'class' => 'form-control input1', 'required' => '']) !!}
			</div>
		</div>
		{{-- Precio Especial --}}
		<div class="form-group form-inline">
			{!! Form::label('pjeespecial', '% Especial') !!}
			<div class="horiz-double-input">
				{!! Form::text('pjeespecial', null, ['id'=>'PjeEspecialIpt', 'class' => 'form-control input1', 'required' => '']) !!}
				{!! Form::text('precioespecial', null, ['id' => 'PrecioEspecialDisp', 'class' => 'form-control input2', 'disabled' => '']) !!}
			</div>
		</div>
	</div>
	
	<div class="col-md-3">
		{{-- /// --}}
		<div class="col-md-6 mar0 pad0">
			<div class="form-group form-inline">
				{!! Form::label('stocklocal', 'Stock Local') !!}
				{!! Form::text('stocklocal', null, ['class' => 'form-control  short-input', 'placeholder' => '', 'required' => '']) !!}
			</div>
		</div>
		<div class="col-md-6 mar0 pad0">
			<div class="form-group form-inline">
				{!! Form::label('stockactual', 'Stock Depósito') !!}
				{!! Form::text('stockactual', null, ['class' => 'form-control  short-input', 'placeholder' => '', 'required' => '']) !!}
			</div>
		</div>
		{{-- /// --}}
		<div class="form-group">
			{!! Form::label('stockmin', 'Stock Mínimo') !!}
			{!! Form::text('stockmin', null, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
		</div>
		{{-- /// --}}
		<div class="form-group">
			{!! Form::label('stockmax', 'Stock Máximo') !!}
			{!! Form::text('stockmax', null, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
		</div>
		{{-- /// --}}
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Tipo</label>
		</div>
		<div class="checkbox">
			<label><input type="radio" name="origen" value="" @if($origin == null) checked @endif></label>  <br>
			<label><input type="radio" name="origen" value="*" @if($origin == '*') checked @endif>*</label>  <br>
			<label><input type="radio" name="origen" value="**" @if($origin == '**') checked @endif>**</label>  <br>
		</div>
	</div>
</div>
<div class="row inner-row">
	<br>
	<div class="col-lg-12">
	@if(isset($oferta))
		@if($oferta == 'off')
			<label for="primary" class="btn btn-primary">Ofertar <input name="oferta" type="checkbox" id="primary" class="OfferCheckbox badgebox"><span class="badge">&check;</span></label>
		@elseif($oferta == 'on')
			<label for="primary" class="btn btn-primary">Ofertar <input name="oferta" type="checkbox" id="primary" class="OfferCheckbox badgebox" checked><span class="badge">&check;</span></label>
		@endif
	@else
		<label for="primary" class="btn btn-primary">Ofertar <input name="oferta" type="checkbox" id="primary" class="OfferCheckbox badgebox"><span class="badge">&check;</span></label>
	@endif

	</div>
</div>
<div id="OfferContainer" class="inner-row boxed-row">
	{{-- Oferta --}}
	<div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<div class="horiz-double-input">
				<div class="inner1">
					{!! Form::label('pjeoferta', '%') !!}
					{!! Form::text('pjeoferta', null, ['id'=>'PjeOfertaIpt', 'class' => 'form-control']) !!}
				</div>
				<div class="inner2">
					{!! Form::label('preciooferta', 'Precio Oferta') !!}
					{!! Form::text('preciooferta', null, ['id' => 'PrecioOfertaDisp', 'class' => 'form-control', 'disabled' => '']) !!}
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
		<div class="form-group">
			{!! Form::label('cantoferta', 'Cantidad mínima (Oft.)') !!}
			{!! Form::text('cantoferta', null, ['class' => 'form-control']) !!}
		</div>
	</div>
<div class="clearfix"></div>
</div>
<br>
{{-- SubTitle --}}
{{-- <div class="row sub-title"><div class="col-md-12">
	<div class="inner-sub-title"><i class="ion-clipboard icon"></i><span> Stock</span></div>
</div></div> --}}
{{-- STOCK AND STATUS --}}
<div class="row inner-row">
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('estado', 'Estado Inicial') !!}
			{!! Form::select('estado', ['activo' => 'Listar', 'pausado' => 'No Listar'], null, ['class' => 'form-control Select-Chosen', 'required' => '']) !!}
		</div>
	</div>
</div>
<div class="row inner-row">
</div>
<hr class="softhr">
