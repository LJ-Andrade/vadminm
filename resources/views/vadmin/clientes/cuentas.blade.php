@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Mataderos Distribuciones')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Cuentas Corrientes') 
	@section('options')
		<div class="actions">
         
		</div>	
	@endsection
@endsection

@section('styles')
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}
@endsection


@section('content')

<div class="container">
	<div class="row">
		<div class="narrow-form">
			<div class="inner">
				{{-- Title --}}
				<div class="title">
					<span>Creación de pedido</span>
				</div>
				<div class="row content">
                    <div class="form-group col-md-7">
                        {{-- Search By Name --}}
                        {!! Form::label('cliente', 'Buscar por nombre') !!}
                        {!! Form::text('cliente', null, ['id' => 'ClientAutoComplete', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-md-5">
                        {{-- Search By Code  --}}
                        {!! Form::label('codigo', 'Buscar por código') !!}
                        {!! Form::number('codigo', null, ['id' => 'ClientByCode', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-12">
                        <button id="ClientByCodeBtn" class="btnSm btnBlue"> Buscar</button>
                    </div>
                </div>
				<div class="clearfix"></div>
				{{-- Output --}}
				<div id="SmallLoader"></div>
				<div id="ClientOutPut" class="Hidden">
					<div class="output-box">
						<h4><b>Cliente seleccionado:</b></h4>
						<div id="ClientData"></div>
                        <input id="ClienteIdOutput" type="hidden">
						<div id="OutPutForm">
							<button id="GoToAccount" class="button buttonOk"> Ver Cuenta</button>
						</div>
					</div>
				</div>
				<div id="ClientError" class="output-box Hidden">
					El cliente no existe
				</div>
			</div> {{-- / inner --}}
		</div>  {{-- / narrow form  --}}
	</div> 	{{-- / row  --}}
</div>  {{-- / container  --}}


@endsection

@section('scripts')
    @include('vadmin.components.ajaxscripts')
@endsection

@section('custom_js')

	<script type="text/javascript">

		// Search and Redirect to Client Account
		$('#GoToAccount').click(function(e){
			e.preventDefault();
			var id = $('#ClienteIdOutput').val();
			var route  = "{{ url('vadmin/clientes/cuenta') }}/id="+id+"/month=0/year=0/action=show";
			window.location.href = route;
		});

    </script>

@endsection