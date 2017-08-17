{{-- //---------------Datos Principales---------------// --}}
{{-- SubTitle --}}
<div class="row sub-title"><div class="col-md-12">
	<div class="inner-sub-title"><i class="ion-clipboard icon"></i><span> Datos Principales</span></div>
</div></div>

<div class="row inner-row">
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
			{!! Form::label('nombre', 'Descripción') !!}
			{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la descripción', 'required' => '']) !!}
		</div>
	</div>
</div>
<div class="row inner-row">
	{{-- /// --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('proveedor_id', 'Proveedor') !!}
			{!! Form::select('proveedor_id', $proveedor, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion', 'required' => '']) !!}
		</div>
	</div>
	{{-- /// --}}
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('codproveedor', 'Código de Proveedor') !!}
			{!! Form::text('codproveedor', null, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
		</div>
	</div>
</div>

{{-- /// Precios /// --}}
<div class="row sub-title">
	<div class="col-md-12">
		<div class="inner-sub-title">
			<i class="ion-social-usd icon"></i><span> Valores</span>
		</div>
	</div>
</div>
<div class="row row-inner">
	{{-- Precio de Costo --}}
	<div class="col-md-4 col-sm-4 col-xs-12">
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
	</div>
	{{-- Moneda --}}
	<div class="col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			{!! Form::label('monedacompra', 'Moneda') !!}
			{!! Form::select('monedacompra', $monedas, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion', 'required' => '']) !!}
		</div>
	</div>
	{{-- Condicion Iva --}}
	<div class="col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			{!! Form::label('condiva', 'Impuesto') !!}
			{!! Form::select('condiva', ['21' => '21 %', '10.5' => '10.5 %'], null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion', 'required' => '']) !!}
		</div>
	</div>
</div>
<div class="row inner-row">
	{{-- Precio al Gremio --}}
	<div class="col-lg-4 col-sm-6 col-xs-12">
		<div class="form-group">
			<div class="horiz-double-input">
				<div class="inner1">
					{!! Form::label('pjegremio', '%') !!}
					{!! Form::text('pjegremio', null, ['id'=>'PjeGremioIpt', 'class' => 'form-control', 'required' => '']) !!}
				</div>
				<div class="inner2">
					{!! Form::label('preciogremio', 'Precio al Gremio') !!}
					{!! Form::text('preciogremio', null, ['id' => 'PrecioGremioDisp', 'class' => 'form-control', 'disabled' => '' ]) !!}
				</div>
			</div>
		</div>
	</div>
	{{-- Precio Particular --}}
	<div class="col-lg-4 col-sm-6 col-xs-12">
		<div class="form-group">
			<div class="horiz-double-input">
				<div class="inner1">
					{!! Form::label('pjeparticular', '%') !!}
					{!! Form::text('pjeparticular', null, ['id'=>'PjeParticularIpt', 'class' => 'form-control', 'required' => '']) !!}
				</div>
				<div class="inner2">
					{!! Form::label('precioparticular', 'Precio a Particular') !!}
					{!! Form::text('precioparticular', null, ['id' => 'PrecioParticularDisp', 'class' => 'form-control', 'disabled' => '']) !!}
				</div>
			</div>
		</div>
	</div>
	{{-- Precio Especial --}}
	<div class="col-lg-4 col-sm-12 col-xs-12">
		<div class="form-group">
			<div class="horiz-double-input">
				<div class="inner1">
					{!! Form::label('pjeespecial', '%') !!}
					{!! Form::text('pjeespecial', null, ['id'=>'PjeEspecialIpt', 'class' => 'form-control', 'required' => '']) !!}
				</div>
				<div class="inner2">
					{!! Form::label('precioespecial', 'Precio Especial') !!}
					{!! Form::text('precioespecial', null, ['id' => 'PrecioEspecialDisp', 'class' => 'form-control', 'disabled' => '']) !!}
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row inner-row">
	{{-- Oferta --}}
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<div class="horiz-double-input">
				<div class="inner1">
					{!! Form::label('pjeoferta', '%') !!}
					{!! Form::text('pjeoferta', null, ['id'=>'PjeOfertaIpt', 'class' => 'form-control', 'required' => '']) !!}
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
	</div>
<br>
{{-- SubTitle --}}
<div class="row sub-title"><div class="col-md-12">
	<div class="inner-sub-title"><i class="ion-clipboard icon"></i><span> Stock</span></div>
</div></div>
<div class="row inner-row">
	{{-- /// --}}
	<div class="col-md-4 col-sm-6 col-xs-6">
		<div class="form-group">
			{!! Form::label('stockactual', 'Stock Actual') !!}
			{!! Form::text('stockactual', null, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
		</div>
	</div>
		{{-- /// --}}
	<div class="col-md-4 col-sm-6 col-xs-6">
		<div class="form-group">
			{!! Form::label('stockmin', 'Stock Mínimo') !!}
			{!! Form::text('stockmin', null, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
		</div>
	</div>
		{{-- /// --}}
	<div class="col-md-4 col-sm-6 col-xs-6">
		<div class="form-group">
			{!! Form::label('stockmax', 'Stock Máximo') !!}
			{!! Form::text('stockmax', null, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
		</div>
	</div>

</div>
<div class="row inner-row">
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('estado', 'Listar o No listar en listas de precios') !!}
			{!! Form::select('estado', ['activo' => 'Listar', 'pausado' => 'No Listar'], null, ['class' => 'form-control Select-Chosen', 'required' => '']) !!}
		</div>
	</div>
</div>
<hr class="softhr">
