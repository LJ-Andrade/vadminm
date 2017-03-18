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
                    <div class="inner-sub-title"><i class="ion-clipboard icon"></i><span> Datos Principales</span></div>
                </div></div>
                <div class="row inner-row">
					{{-- /// --}}
					<div class="col-md-2 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('id', 'Código') !!}
							{!! Form::text('id', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el código']) !!}
						</div>
					</div>
					{{-- /// --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('razonsocial', 'Razón Social') !!}
							{!! Form::text('razonsocial', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la Razón Social']) !!}
						</div>
					</div>
                    {{-- /// --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('iva', 'Categoría de IVA') !!}
							{!! Form::select('iva',  $iva, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
						</div>
					</div>
                     {{-- /// --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('cuit', 'N° de CUIT') !!}
							{!! Form::text('cuit', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el CUIT', 'maxlength' => '11', 'minlength' => '11', 'data-mask'=>'00-00000000-0']) !!}
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
							{!! Form::select('provincia',  $provincias, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
						</div>
					</div>
					{{-- Loc. --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('localidad', 'Localidad') !!}
							{!! Form::select('localidad',  $localidades, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
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
                   {{-- //-------------------------------------------------// --}}
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
							{!! Form::select('condicventas', $condicventas, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
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
				    {{-- Vendedor Designado --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('vendedor', 'Vendedor') !!}
							{!! Form::select('vendedor', $users, null, ['class' => 'form-control Select-Chosen', 'placeholder' => 'Seleccione una opcion']) !!}
						</div>
					</div>
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
                {{-- Resto del Form Acá--}}

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
							{!! Form::text('telefonos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un teléfono', 'data-mask'=>'0000-0000 | 0000-0000 | 0000-0000']) !!}
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
							{!! Form::text('cell', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un celular', 'data-mask'=>'(00)0000-0000 | (00)0000-0000 | (00)0000-0000']) !!}
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
                <div class="row sub-title"><div class="col-md-12">
                    <div class="inner-sub-title"><i class="ion-map icon"></i><span> Direcciones de Entrega</span>
					<button type="button" class="OpenDirsEntregaBtn btnSm buttonGrey"><i class="ion-chevron-right"></i></button></div>
                </div></div>
                <div class="row inner-row">
                   {{-- Dirección de Entrega --}}
					<div class="col-md-12 col-sm-6 col-xs-12">							
						<div class="DirsEntregaDiv box-container animated fadeIn clearfix Hidden">
							<div class="CloseDirsEntregaBtn btnCloseDark"><i class="ion-close-round"></i></div>
							<div class="col-md-6 form-group">
								<div class="AnotherAddress">
									{!! Form::label('', 'Calle') !!}
									{!! Form::text('', null, ['class' => 'form-control', 'placeholder' => 'Domicilio de entrega', 'id' => 'DirEntrega']) !!}
									{!! Form::label('', 'Localidad') !!}
									{!! Form::select('',  $localidades, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opcion', 'id' => 'LocEntrega']) !!}
								</div>
                            </div>
							<div class="col-md-6 form-group">
								<div class="AnotherAddress">
									{!! Form::label('', 'Teléfono') !!}
									{!! Form::text('', null, ['class' => 'form-control', 'placeholder' => 'Domicilio de entrega', 'id' => 'TelEntrega']) !!}
									{!! Form::label('', 'Provincia') !!}
									{!! Form::select('',  $provincias, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opcion', 'id' => 'ProvEntrega']) !!}
								</div>
                            </div>
							<button type="button" class="AddDirsEntregaBtn btnSm buttonOk">Agregar Dirección de Entrega</button>	
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
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
@endsection

@section('custom_js')
	
	<script>

		// ------------------- Textarea Text Editor --------------------------- //
		// Path to icons
		$.trumbowyg.svgPath = '{{ asset('plugins/texteditor/icons.svg') }}';
		// Init
		$('.Textarea-Editor').trumbowyg();

	
		$('.AddDirsEntregaBtn').click(function(){
			var dirEntrega  = $('#DirEntrega').val();
			var locEntrega  = $('#LocEntrega option:selected').text();
			var telEntrega  = $('#TelEntrega').val();
			var provEntrega = $('#ProvEntrega option:selected').text();

			if(dirEntrega == '' || locEntrega == '') {
				alert_error('Ups!','Faltan datos de entrega');
			} else {
				//var inputDir   = "<input class='Hidden' type='text' name='direntrega[]' value='"+dirEntrega+','+provEntrega+','+locEntrega+','+telEntrega+"'>";

				var dirCard    = "<div class='col-md-12 small-card'>"
									+"<span>"+ dirEntrega +"</span> - <span>"+ provEntrega +"</span> - <span>"+ locEntrega +"</span> - <span>"+ telEntrega +"</span>"
									+"<div class='btnCloseThis'><i class='ion-trash-b'></i></div>"
								+"</div><br>";
				var input1		= "<input type='text' class='Hidden' name='direntrega[]' value='"+ dirEntrega +"'>";
				var input3		= "<input type='text' class='Hidden' name='telentrega[]' value='"+ telEntrega +"'>";
				var input2		= "<input type='text' class='Hidden' name='locentrega[]' value='"+ locEntrega +"'>";
				var input4		= "<input type='text' class='Hidden' name='proventrega[]' value='"+ provEntrega +"'>";

				


				console.log(input1);
				console.log(input2);
				console.log(input3);
				console.log(input4);
				$('#DirEntregaDiv').append(input1 + input2 + input3 + input4 +'<br>'+dirCard);
			}
			
		});

	</script>

@endsection


