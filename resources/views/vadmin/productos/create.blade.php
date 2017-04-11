@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Productos')

@section('header')
	@section('header_title', 'Ingreso de nuevo producto') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/productos') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	{!! Html::style('plugins/texteditor/trumbowyg.min.css') !!}
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}
	{!! Html::style('plugins/datepicker/bootstrap-datepicker.css') !!}
@endsection

@section('content')
	@component('vadmin.components.mainloader')@endcomponent
	<div class="container">
	        <div class="row">
        	<div id="Error"></div>
        </div>
	    <div class="row">
	        {!! Form::open(['route' => 'productos.store', 'method' => 'POST', 'files' => true, 'id' => 'NewItemForm', 'class' => 'big-form', 'data-parsley-validate' => '']) !!}	
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
							{!! Form::select('familia_id', $familias, null, ['id' => 'FamiliasSelect', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opción']) !!}
						</div>
					</div>
                    {{-- /// --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('subfamilia_id', 'Subfamilia') !!}
							<select name="subfamilia_id" id="SubfamiliasSelect" class="form-control Select-Chosen">
								
							</select>
						{{-- 	{!! Form::select('subfamilia_id', $subfamilias, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opción']) !!} --}}
						</div>
					</div>
					{{-- /// --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('id', 'Código:') !!}	
                     		{!! Form::text('id', $producto_id->id+1, ['class' => 'form-control', 'disabled' => '']) !!}
						</div>
					</div>
                    {{-- /// --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('nombre', 'Descripción') !!}
							{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la descripción']) !!}
						</div>
					</div>
				</div>
				<div class="row inner-row">
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
				</div>

				{{-- /// Precios /// --}}
				<div class="row sub-title">
					<div class="col-md-12">
						<div class="inner-sub-title">
							<i class="ion-social-usd"></i><span> Valores</span>
						</div>
					</div>
				</div>
				<div class="row row-inner">
					{{-- Precio de Costo --}}
					<div class="col-md-2 col-xs-12">
						<div class="form-group">
							{!! Form::label('preciocosto', 'Precio de Costo') !!}
							{!! Form::number('preciocosto', null, ['id' => 'PrecioCostoIpt', 'class' => 'form-control', 'min' => '0', 'placeholder' => '']) !!}
						</div>
					</div>
					{{-- Moneda --}}
					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('moneda', 'Moneda') !!}
							{!! Form::select('moneda', $monedas, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
						</div>
					</div>
					{{-- Condicion Iva --}}
					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('condiva', 'Condición de Iva') !!}
							{!! Form::select('condiva', ['21' => '21 %', '10.5' => '10.5 %'], null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
						</div>
					</div>
					{{-- Oferta --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('oferta', 'Oferta') !!}
							<div class="horiz-checkbox-input">
								<div class="inner1">{!! Form::checkbox('oferta_check', 1, null, ['id' => 'OfertaCheck']) !!}</div>
								<div class="inner2">{!! Form::text('preciooferta', null, ['id' => '', 'class' => 'form-control OfertaInput', 'disabled' => '']) !!}</div>
							</div>
						</div>
					</div>
					{{-- Cantidad Oferta --}}
					<div class="col-md-2 col-sm-6 col-xs-5">
						<div class="form-group">
							{!! Form::label('cantoferta', 'Cantidad') !!}
							{!! Form::number('cantoferta', null, ['class' => 'form-control OfertaInput', 'min' => '0', 'disabled' => '']) !!}
						</div>
					</div>

				</div>
				<div class="row inner-row">
					{{-- Precio al Gremio --}}
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							<div class="horiz-double-input">
								<div class="inner1">
									{!! Form::label('pjegremio', '%') !!}
									{!! Form::text('pjegremio', null, ['id'=>'PjeGremioIpt', 'class' => 'form-control']) !!}
								</div>
								<div class="inner2">
									{!! Form::label('preciogremio', 'Precio al Gremio') !!}
									{!! Form::text('preciogremio', null, ['id' => 'PrecioGremioDisp', 'class' => 'form-control', 'disabled' => '' ]) !!}
								</div>
							</div>
						</div>
					</div>
					{{-- Precio Particular --}}
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							<div class="horiz-double-input">
								<div class="inner1">
									{!! Form::label('pjeparticular', '%') !!}
									{!! Form::text('pjeparticular', null, ['id'=>'PjeParticularIpt', 'class' => 'form-control']) !!}
								</div>
								<div class="inner2">
									{!! Form::label('precioparticular', 'Precio a Particular') !!}
									{!! Form::text('precioparticular', null, ['id' => 'PrecioParticularDisp', 'class' => 'form-control', 'disabled' => '']) !!}
								</div>
							</div>
						</div>
					</div>
					{{-- Precio Especial --}}
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							<div class="horiz-double-input">
								<div class="inner1">
									{!! Form::label('pjeespecial', '%') !!}
									{!! Form::text('pjeespecial', null, ['id'=>'PjeEspecialIpt', 'class' => 'form-control']) !!}
								</div>
								<div class="inner2">
									{!! Form::label('precioespecial', 'Precio Especial') !!}
									{!! Form::text('precioespecial', null, ['id' => 'PrecioEspecialDisp', 'class' => 'form-control', 'disabled' => '']) !!}
								</div>
							</div>
						</div>
					</div>
				</div>

                {{-- SubTitle --}}
				<div class="row sub-title"><div class="col-md-12">
                    <div class="inner-sub-title"><i class="ion-clipboard icon"></i><span> Stock</span></div>
                </div></div>
                <div class="row inner-row">
                 {{-- /// --}}
					<div class="col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							{!! Form::label('stockactual', 'Stock Actual') !!}
							{!! Form::text('stockactual', null, ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>
                     {{-- /// --}}
					<div class="col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							{!! Form::label('stockmin', 'Stock Mínimo') !!}
							{!! Form::text('stockmin', null, ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>
                     {{-- /// --}}
					<div class="col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							{!! Form::label('stockmax', 'Stock Máximo') !!}
							{!! Form::text('stockmax', null, ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>

                </div>
                <div class="row inner-row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('estado', 'Listar') !!}
                            <div class="horiz-checkbox-input">
                                <div class="inner1">{!! Form::checkbox('estado', 'activo', null, ['id' => 'EstadoCheck', 'checked' => '']) !!}</div>
                                <div class="inner2">{!! Form::text('estadotext', 'En lista', ['id' => 'EstadoInput', 'class' => 'form-control', 'placeholder' => '', 'disabled' => '']) !!}</div>
                            </div>
						</div>
				    </div>
                </div>
				<hr class="softhr">
				<div class="row text-center">
					{!! Form::submit('Ingresar Producto', ['class' => 'button buttonOk', 'id' => 'InsertItemBtn']) !!}
				</div>
            {!! Form::close() !!}
        </div>

    </div>  

@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/texteditor/trumbowyg.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/mask/mask.min.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.es.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
@endsection

@section('custom_js')
	
	<script>

		// ------------------- Textarea Text Editor --------------------------- //
		// Path to icons
		$.trumbowyg.svgPath = '{{ asset('plugins/texteditor/icons.svg') }}';
		// Init
		$('.Textarea-Editor').trumbowyg();

		$('.datepicker').datepicker({
			language: "es"
		});

		        // Prevent Submit on Enter
        // $("#NewItemForm").on('submit',function(e) {
        //     e.preventDefault();
        // });
		

        // Oferta Input behavior
        $('#OfertaCheck').click(function(){
            var input = $('.OfertaInput');
            if(input.attr("disabled")){
                input.prop("disabled", false);
            } else {
                input.prop("disabled", true);
				input.val('');
            }
        });

        $('#EstadoCheck').click(function(){
            var text = $('#EstadoInput');

            if($('#EstadoCheck')[0].checked){
                
                text.val("En lista");
            } else {
                console.log('no checkeado');
                
                text.val("No Listar");
            }
        });


		/////////////////////////////////////////////////
        //            SUBFAMILIAS - AJAX               //
        /////////////////////////////////////////////////

		$('#FamiliasSelect').on('change',function(e){
			// console.log(e)
			var id    = e.target.value;
			var route = "{{ url('vadmin/productos_subfamilias') }}/"+id+"";
			$.get(route, function(data){

				// Vacía el Select de OPTIONS
				$('#SubfamiliasSelect').find('option').remove().end();
				// Recorre Array de data traída por ajax
				$.each(data, function(index, subfamilias){
					// Genera los OPTIONS correspondientes
					$('#SubfamiliasSelect').append("<option value='"+subfamilias.id+"'>"+ subfamilias.nombre +"</option>");
				});
				// Hace un update del plugin CHOSEN para que se representen los OPTIONS.
				$('#SubfamiliasSelect').trigger("chosen:updated");
			});
		});

		/////////////////////////////////////////////////
        //               PRICE CALC                    //
        /////////////////////////////////////////////////

		$('#PrecioCostoIpt').keyup(function (e) {
			$('#PjeParticularIpt').val('');
			$('#PjeGremioIpt').val('');
			$('#PjeEspecialIpt').val('');
			$('#PrecioGremioDisp').val('');
			$('#PrecioParticularDisp').val('');
			$('#PrecioEspecialDisp').val('');
		});


		//---------------- Precio Gremio --------------//
        $("#PjeGremioIpt").keyup(function (e) {
			var pjegremio        = $(this).val();
			var preciocosto      = $('#PrecioCostoIpt').val();
			var resultado = calcPtje(preciocosto, pjegremio);
			$('#PrecioGremioDisp').val(resultado);
		});

		//------------- Precio Particular --------------//
		$("#PjeParticularIpt").keyup(function (e) {
			var pjegremio        = $(this).val();
			var preciocosto      = $('#PrecioCostoIpt').val();
			var resultado = calcPtje(preciocosto, pjegremio);
			$('#PrecioParticularDisp').val(resultado);
		});

		//------------- Precio Especial --------------//
		$("#PjeEspecialIpt").keyup(function (e) {
			var pjegremio        = $(this).val();
			var preciocosto      = $('#PrecioCostoIpt').val();
			var resultado = calcPtje(preciocosto, pjegremio);
			$('#PrecioEspecialDisp').val(resultado);
		});


        /////////////////////////////////////////////////
        //                ID BUILDER                   //
        /////////////////////////////////////////////////
        // $(document).keypress(function(e){
        //     if ((e.keyCode || e.which) == 13) {
        //         console.log();
        //     }
        // });

        // $('#Prefijo_Id').focus();


        // $("#Prefijo_Id").keypress(function (e) {
        //     if (e.which == 13) {
        //         var id = $(this).val();
		// 		if(id == '') {

		// 		} else {
        //         var route = "{{ url('vadmin/ajax_build_id') }}/"+id+"";
        
        //         console.log(id);
        //         console.log(route);

        //         $.ajax({
        //             url: route,
        //             method: 'post',             
        //             dataType: "json",
        //             data: {id: id},
        //             success: function(data){
        //                 console.log(data.familia);
        //                 var familia = data.familia;
        //                 $('#CodeLabel').html(familia);
        //             },
        //             error: function(data)
        //             {
        //                 // $('#Error').html(data.responseText);
        //                 console.log(data);	
        //                 var familia = data.familia;
        //                 $('#CodeLabel').html(data.responseText);
        //             },
        //         });

        //     	}

		// 	}
        // });



	</script>

@endsection


