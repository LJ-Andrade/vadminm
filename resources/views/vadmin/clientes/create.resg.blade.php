@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Clientes')

@section('header')
	@section('header_title', 'Ingreso de nuevo cliente') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/clientes') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	{!! Html::style('plugins/texteditor/trumbowyg.min.css') !!}
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}
@endsection

@section('content')
	<div class="container">
	    <div class="row">
	        {!! Form::open(['route' => 'clientes.store', 'method' => 'POST', 'files' => true, 'id' => 'NewItemForm', 'class' => 'big-form', 'data-parsley-validate' => '']) !!}	
                {{-- //-------------------------------------------------// --}}
                {{-- SubTitle --}}
				<div class="row sub-title"><div class="col-md-12">
                    <div class="inner-sub-title"><span>Datos Principales</span></div>
                </div></div>
                <div class="row inner-row">
					{{-- /// --}}
					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('id', 'Código') !!}
							{!! Form::text('id', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el código', 'id' => 'TitleInput', 
							'required' => '']) !!}
						</div>
					</div>
					{{-- /// --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('razonsocial', 'Razón Social') !!}
							{!! Form::text('razonsocial', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la Razón Social', 'id' => 'TitleInput', 
							'required' => '']) !!}
						</div>
					</div>
                    {{-- /// --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('iva', 'Categoría de IVA') !!}
							{!! Form::select('iva',  $iva, null, ['class' => 'form-control Select-Category', 'placeholder' => 'Seleccione una opcion',
							'required' => '']) !!}
						</div>
					</div>
                     {{-- /// --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('cuit', 'N° de CUIT') !!}
							{!! Form::text('cuit', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el CUIT', 
							'required' => '', 'maxlength' => '11', 'minlength' => '11']) !!}
						</div>
					</div>
				</div>

				<div class="row inner-row">
                    {{-- Dirección --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('dirfiscal', 'Dirección Fiscal') !!}
							{!! Form::text('dirfiscal', null, ['class' => 'form-control', 'placeholder' => 'Dirección Fiscal',
							'required' => '']) !!}
						</div>
					</div>
					{{-- Provinces --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('provincia', 'Provincia') !!}
							{!! Form::select('provincia',  $provincias, null, ['class' => 'form-control Select-Category', 'placeholder' => 'Seleccione una opcion',
							'required' => '']) !!}
						</div>
					</div>
					{{-- Loc. --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('localidad', 'Localidad') !!}
							{!! Form::select('localidad',  $localidades, null, ['class' => 'form-control Select-Category', 'placeholder' => 'Seleccione una opcion',
							'required' => '']) !!}
						</div>
					</div>
					{{-- Postal Code --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('codpostal', 'Cod. Postal') !!}
							{!! Form::text('codpostal', null, ['class' => 'form-control', 'placeholder' => 'Código Postal',
							'required' => '']) !!}
						</div>
					</div>
				</div>
                {{-- //-------------------------------------------------// --}}
                {{-- SubTitle --}}
				<div class="row sub-title"><div class="col-md-12">
                    <div class="inner-sub-title"><span>Ventas</span></div>
                </div></div>
				<div class="row inner-row">
                    {{-- Limite de credito --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('limitcred', 'Límite de Crédito') !!}
							{!! Form::text('limitcred', null, ['class' => 'form-control', 'placeholder' => 'Ingrese límite',
							'required' => '']) !!}
						</div>
					</div>
					{{-- Condicion de venta --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('condicionvta', 'Condiciones de Vta.') !!}
							{!! Form::select('condicionvta',  $condicventas, null, ['class' => 'form-control Select-Category', 'placeholder' => 'Seleccione una opcion',
							'required' => '']) !!}
						</div>
					</div>
                    {{-- Lista de Precios --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('listaprecios', 'Lista de Precios') !!}
							{!! Form::select('listaprecios',  $lista, null, ['class' => 'form-control Select-Category', 'placeholder' => 'Seleccione una opcion',
							'required' => '']) !!}
						</div>
					</div>
				</div>
                <div class="row inner-row">
				    {{-- Vendedor Designado --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('vendedor', 'Vendedor') !!}
							{!! Form::select('vendedor',  $users, null, ['class' => 'form-control Select-Category', 'placeholder' => 'Seleccione una opcion',
							'required' => '']) !!}
						</div>
					</div>
					{{-- Flete --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('zona', 'Zona') !!}
							{!! Form::select('zona',  $zona, null, ['class' => 'form-control Select-Category', 'placeholder' => 'Seleccione una opcion',
							'required' => '']) !!}
						</div>
					</div>
                    {{-- Flete --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('flete', 'Flete') !!}
							{!! Form::select('flete',  $flete, null, ['class' => 'form-control Select-Category', 'placeholder' => 'Seleccione una opcion',
							'required' => '']) !!}
						</div>
					</div>
				</div>
                 {{-- //-------------------------------------------------// --}}
                {{-- Datos de contacto y entrega --}}
				<div class="row sub-title"><div class="col-md-12">
                    <div class="inner-sub-title"><span>Datos de contacto</span></div>
                </div></div>
				<div class="row inner-row">
                    {{-- Teléfonos --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group multiple-items">
							{!! Form::label('telefonos', 'Teléfonos') !!}
                            <div class="TelInputs">
							{!! Form::text('telefonos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un teléfono',
							'required' => '']) !!}
                            </div>
                         {{--<div class="AddAnother add-another"><button type="button" class="AddAnotherTelBtn transBtn">
                                <i class="ion-ios-plus-outline"></i> Agregar otro teléfono</button>
                            </div>--}}
						</div>
					</div>
                     {{-- Teléfonos --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group multiple-items">
							{!! Form::label('cell', 'Celular') !!}
							{!! Form::text('cell', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un celular',
							'required' => '']) !!}
						</div>
					</div>
					{{-- E-Mail --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group multiple-items">
							{!! Form::label('email', 'E-Mail') !!}
							{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un E-mail',
							'required' => '']) !!}
						</div>
					</div>
				</div>
                {{-- //-------------------------------------------------// --}}
                {{-- Datos de contacto y entrega --}}
                <div class="row sub-title"><div class="col-md-12">
                    <div class="inner-sub-title"><span>Direcciones de Entrega</span></div>
                </div></div>
                <div class="row inner-row inner-box">
                   {{-- Dirección de Entrega --}}

					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group multiple-items">
							{!! Form::label('entregacalle', 'Calle') !!}
                            <div class="AnotherAddress">
							{!! Form::text('entregacalle', null, ['class' => 'form-control', 'placeholder' => 'Domicilio de entrega',
							'required' => '']) !!}
                            </div>
                            <div class="AddAnotherAddress add-another"><button type="button" class="AddAnotherAddressBtn transBtn">
                                <i class="ion-ios-plus-outline"></i> Agregar otra dirección</button>
                            </div>
						</div>
					</div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('entregalocalidad', 'Localidad') !!}
                            <div class="AnotherLoc">
							{!! Form::select('entregalocalidad',  $localidades, null, ['class' => 'form-control Select-Category', 'placeholder' => 'Seleccione una opcion']) !!}
                            </div>
						</div>
					</div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
						
					</div>
                </div>
                <hr class="softhr">

                {{-- Content --}}
                <button type="button" class="ShowNotesTextArea btnSm buttonOk">Agregar Notas</button>
				<div class="form-group animated fadeIn NotesTextArea Hidden">
					{!! Form::label('content', 'Notas') !!}
					{!! Form::textarea('content', null, ['class' => 'form-control Textarea-Editor']) !!}
				</div>
				<div class="row text-center">
					{!! Form::submit('Ingresar Cliente', ['class' => 'button buttonOk']) !!}
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
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
@endsection

@section('custom_js')
	
	<script>

		// ------------------- Textarea Text Editor --------------------------- //
		// Path to icons
		$.trumbowyg.svgPath = '{{ asset('plugins/texteditor/icons.svg') }}';
		// Init
		$('.Textarea-Editor').trumbowyg();

		// ----------------------- Color Picker --------------------------------//
		// Add Color Selector
		$(".ColorPicker").spectrum({
			
			color: "#fff",
			change: function(color) {
				// var div = ;
				var hex = color.toHexString(); // #ff0000
				// alert(div);
				$('.ColorPickerList').append("<div class='picked-color' style='background-color:"+ hex +"'><input type='hidden' name='color' value='"+ hex +"'></div>");
				console.log(hex);
			}
		});

	</script>

@endsection


