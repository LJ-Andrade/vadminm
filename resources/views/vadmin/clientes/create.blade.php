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
            	@include ('vadmin.clientes.form')
            {!! Form::close() !!}
        </div>
    </div>  
	<div id="Error"></div>

@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/texteditor/trumbowyg.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/mask/mask.min.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
	
	@include('vadmin.components.ajaxscripts')
@endsection

@section('custom_js')
	
	<script>

		// ------------------- Textarea Text Editor --------------------------- //
		// Path to icons
		$.trumbowyg.svgPath = '{{ asset('plugins/texteditor/icons.svg') }}';
		// Init
		$('.Textarea-Editor').trumbowyg();

	
		$('.AddDirsEntregaBtn').click(function(){
			var clientId    = $('#Client_Id').val();
			var clientName  = $('#RazonSocial').val();
			var dirEntrega  = $('#DirEntrega').val();
			var locEntrega  = $('#LocEntrega option:selected').text();
			var telEntrega  = $('#TelEntrega').val();
			var provEntrega = $('#ProvEntrega option:selected').text();

			if(dirEntrega == '' || locEntrega == '') {
				alert_error('Ups!','Faltan datos de entrega');
			} else {
				var dirCard ="<div class='col-md-12 small-card'>"
						 	+"<span>"+ dirEntrega +"</span> - <span>"+ provEntrega +"</span> - <span>"+ locEntrega +"</span> - <span>"+ telEntrega +"</span>"
						 	+"<div class='btnCloseThis'><i class='ion-trash-b'></i></div>"
						    +"</div><br>";

				var input1 = "<input type='text' class='Hidden' name='direntrega[]'  value='"+ dirEntrega  +"'>";
				var input3 = "<input type='text' class='Hidden' name='telentrega[]'  value='"+ telEntrega  +"'>";
				var input2 = "<input type='text' class='Hidden' name='locentrega[]'  value='"+ locEntrega  +"'>";
				var input4 = "<input type='text' class='Hidden' name='proventrega[]' value='"+ provEntrega +"'>";

				
				$('#DirEntregaDiv').append(input1 + input2 + input3 + input4 +'<br>'+dirCard);
			}
			
		});


	</script>

@endsection


