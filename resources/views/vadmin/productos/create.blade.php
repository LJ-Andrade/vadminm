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
							{!! Form::label('id', 'Código | Familia:') !!}	
                            {{-- {!! Form::label('id', '', ['id' => 'CodeLabel']) !!} --}}
                            <label type="text" id="CodeLabel"></label>
                                <div class="horiz-double-input">
                                    <div class="inner1">{!! Form::text('prefijo', null, ['id'=>'Prefijo_Id', 'class' => 'form-control']) !!}</div>
                                    <div class="inner2">{!! Form::text('id', null, ['id' => 'IdInput', 'class' => 'form-control', 'disabled' => '']) !!}</div>
                                </div>
							{{-- {!! Form::text('id', $producto_id->id+1, ['id'=>'Cliente_Id','class' => 'form-control', 'disabled'=>'', 'placeholder' => 'Ingrese el código', 'id'=>'Client_Id']) !!} --}}
							{!! Form::text('id_direntrega', $producto_id->id+1, ['id'=>'Cliente_Id', 'class' => 'form-control Hidden', 'placeholder' => 'Ingrese el código', 'id'=>'CLIENTID']) !!}
						</div>
					</div>
                    {{-- /// --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('nombre', 'Descripción') !!}
							{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la descripción']) !!}
						</div>
					</div>
					{{-- /// --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('unidad', 'Unidad') !!}
							{!! Form::text('unidad', null, ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('updated_at', 'Fecha Modificación') !!}
							{!! Form::text('updated_at', null, ['class' => 'form-control datepicker', 'placeholder' => 'Fecha de modificación']) !!}
						</div>
					</div>
				</div>

                <div class="row inner-row">
                    {{-- /// --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('familia', 'Familia') !!}
							{!! Form::select('familia', $familias, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
						</div>
					</div>
                    {{-- /// --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('subfamilia', 'Subamilia') !!}
							{!! Form::select('subfamilia', $subfamilias, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
						</div>
					</div>
                    {{-- /// --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('proveedor', 'Proveedor') !!}
							{!! Form::select('proveedor', $proveedor, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
						</div>
					</div>
                </div>

                {{-- SubTitle --}}
				<div class="row sub-title"><div class="col-md-12">
                    <div class="inner-sub-title"><i class="ion-clipboard icon"></i><span> $</span></div>
                </div></div>
                <div class="row inner-row">
                 {{-- /// --}}
					<div class="col-md-2 col-sm-6 col-xs-6">
						<div class="form-group">
							{!! Form::label('stockactual', 'Stock Actual') !!}
							{!! Form::text('stockactual', null, ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>
                     {{-- /// --}}
					<div class="col-md-2 col-sm-6 col-xs-6">
						<div class="form-group">
							{!! Form::label('stockmin', 'Stock Mínimo') !!}
							{!! Form::text('stockmin', null, ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>
                     {{-- /// --}}
					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('stockmax', 'Stock Máximo') !!}
							{!! Form::text('stockmax', null, ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>
                    {{-- /// --}}
					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('preciocosto', 'Precio de Costo') !!}
							{!! Form::text('preciocosto', null, ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>
                </div>

                <div class="row inner-row">
                    {{-- /// --}}
					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('preciogremio', 'Precio al Gremio') !!}
							{!! Form::text('preciogremio', null, ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>
                    {{-- /// --}}
					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('precioparticular', 'Precio a Particular') !!}
							{!! Form::text('precioparticular', null, ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>
                    {{-- /// --}}
					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('precioespecial', 'Precio Especial') !!}
							{!! Form::text('precioespecial', null, ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>
                	<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('oferta', 'Oferta') !!}
                            <div class="horiz-checkbox-input">
                                <div class="inner1">{!! Form::checkbox('oferta_check', 1, null, ['id' => 'OfertaCheck']) !!}</div>
                                <div class="inner2">{!! Form::text('oferta', null, ['id' => 'OfertaInput', 'class' => 'form-control', 'placeholder' => '', 'disabled' => '']) !!}</div>
                            </div>
						</div>
				    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('estado', 'Listar') !!}
                            <div class="horiz-checkbox-input">
                                <div class="inner1">{!! Form::checkbox('estado_check', 1, null, ['id' => 'EstadoCheck', 'checked' => '']) !!}</div>
                                <div class="inner2">{!! Form::text('estado', 'En lista', ['id' => 'EstadoInput', 'class' => 'form-control', 'placeholder' => '', 'disabled' => '']) !!}</div>
                            </div>
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
					{!! Form::submit('Ingresar Producto', ['class' => 'button buttonOk']) !!}
				</div>
            {!! Form::close() !!}
        </div>
        <div class="row">
        	<div id="Error"></div>
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
        $("#NewItemForm").on('submit',function(e) {
            e.preventDefault();
        });



        // Oferta Input behavior
        $('#OfertaCheck').click(function(){
            var input = $('#OfertaInput');
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
        //                ID BUILDER                   //
        /////////////////////////////////////////////////
        // $(document).keypress(function(e){
        //     if ((e.keyCode || e.which) == 13) {
        //         console.log();
        //     }
        // });

        $('#Prefijo_Id').focus();


        $("#Prefijo_Id").keypress(function (e) {
            if (e.which == 13) {
                var id = $(this).val();
				if(id == '') {

				} else {
                var route = "{{ url('vadmin/ajax_build_id') }}/"+id+"";
        
                console.log(id);
                console.log(route);

                $.ajax({
                    url: route,
                    method: 'post',             
                    dataType: "json",
                    data: {id: id},
                    success: function(data){
                        console.log(data.familia);
                        var familia = data.familia;
                        $('#CodeLabel').html(familia);
                    },
                    error: function(data)
                    {
                        // $('#Error').html(data.responseText);
                        console.log(data);	
                        var familia = data.familia;
                        $('#CodeLabel').html(data.responseText);
                    },
                });

            	}

			}
        });



	</script>

@endsection


