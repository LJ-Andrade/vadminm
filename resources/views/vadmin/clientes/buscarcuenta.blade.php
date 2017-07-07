@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Pagos')

@section('header')
	@section('header_title', 'Creación de Pagos') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/pagos') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')

    <div class="container">
        <div id="ClientFinder" class="narrow-form">
            <div class="inner">
                {{-- Title --}}
                <div class="title">
                    <span>INGRESAR UN PAGO</span>
                </div>
                {{-- By Name Search --}}
                <div class="form-group">
                    {!! Form::label('cliente', 'Buscar por nombre') !!}
                    {!! Form::text('cliente', null, ['id' => 'ClientAutoComplete', 'class' => 'form-control']) !!}
                </div>
                {{-- By Code Search --}}
                <div class="form-group">
                    {!! Form::label('codigo', 'Buscar por código') !!}
                    {!! Form::number('codigo', null, ['id' => 'ClientByCode', 'class' => 'form-control']) !!}
                    <button id="ClientByCodeBtn" class="btnSm btnBlue"> Buscar</button>
                </div>
            
                {{-- Output --}}
                <div id="SmallLoader"></div>
                <div id="ClientOutPut" class="Hidden">
                    <div class="output-box">
                        <h4><b>Cliente seleccionado:</b></h4>
                        <div id="ClientData"></div>
                        <div id="OutPutForm">
                            {!! Form::open(['method' => 'POST', 'id' => 'NewItemForm']) !!}
                                <div class="col-md-12">
                                    <input type="text" name="user_id" class="Hidden" value="{{ Auth::user()->id }}">
                                </div>
                                {!! Form::text('cliente_id', null, ['id' => 'ClienteIdOutput', 'class' => 'form-control Hidden', 'required' => '']) !!} 
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div id="ClientError" class="output-box Hidden">
                    El cliente no existe
                </div>
            </div>
        </div>




    </div> {{-- Container --}}

@endsection


@section('scripts')
	{{-- <script type="text/javascript" src="{{ asset('plugins/texteditor/trumbowyg.min.js')}} "></script> --}}
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/mask/mask.min.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('plugins/jqueryUi/jquery-ui.min.js')}} "></script>
    @include('vadmin.components.ajaxscripts')
@endsection


@section('custom_js')
	<script>
	/////////////////////////////////////////////////////////
	//             Get and Set Client Data                 //
	/////////////////////////////////////////////////////////

	// Get Client Data On Button Click
	$('#ClientByCodeBtn').click(function(){
		// Get Client Full Data
		
		var id         = $('#ClientByCode').val();
		var route      = "{{ url('vadmin/get_client') }}/"+id+"";
		
		getClientData(route).done(function(data){
			
			if (data.client != null){
				var id          = data.client['id'];
				var razonsocial = data.client['razonsocial'];
			} 
			// Send Client Data to Output
			output(id, razonsocial);
		});
	});

	// Get Client Data OnKeydown
	$("#ClientByCode").on("keydown", function(e) {
		if(e.which == 13) {
			$('#ClientByCodeBtn').click();
		}
	});
	
	// Get Client Data On Autocomplete Input
	$('#ClientAutoComplete').autocomplete({
		source: "{!!URL::route('client_autocomplete')!!}",
		minlength: 1,
		autoFocus: true,
		search: function(){
			$('#SmallLoader').html(loaderSm('Buscando...'));
		},
		select:function(e,data)
		{
			var id    = data.item.id;
			var route = "{{ url('vadmin/get_client') }}/"+id+"";

			// Get Client Full Data
			getClientData(route).done(function(data){
				var id          = data.client['id'];
				var razonsocial = data.client['razonsocial'];
                
				// Send Client Data to Output
				output(id, razonsocial);
			});
			
		},
		response: function(event, ui) {
			$('#SmallLoader').html('');
		},
	});



	// Print Selected Data and Fill Inputs
	function output(id, razonsocial){
		var output      = $('#ClientData');
		var outputerror = $('#ClientError');
        var link        = "{{ url('vadmin/clientes/cuenta') }}/"+id+"";
        var btn         = "<a href='"+link+"'><button class='button btnSm btnGreen'> Ver Cuenta Corriente</button></a>";
        console.log(link);
		if(id != null){
			$('#ClienteIdOutput').val(id);
			$('#ClientOutPut').removeClass('Hidden');
			output.html('Cód.:' + id + ' | ' + razonsocial+ '<br>');
            output.append(btn);
			outputerror.addClass('Hidden');
		} else {
			$('#ClientOutPut').addClass('Hidden');
			outputerror.removeClass('Hidden');
		}
	}

    </script>
@endsection