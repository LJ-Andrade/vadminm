@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Pedidositems')

@section('header')
	@section('header_title', 'Creación de Pedidositems') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/pedidositems') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
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
        <div class="small-form container animated fadeIn">
            {!! Form::open(['url' => 'vadmin/pedidositems', 'data-parsley-validate' => '']) !!}
            <div class="row inner">
                <div class="col-md-12 title">
                    <span><i class="ion-plus-round"></i> Creación de Nuevo Item</span>
                    <a href="{{ url('vadmin/pedidositems') }}"><div class="close-btn2"><i class="ion-close-round"></i></div></a>
                </div>
                
                <div class=" col-md-12 form-group">
                    {!! Form::label('pedido', 'Pedido:') !!}
                    {!! Form::select('pedido', $pedidos, null, ['id' => 'PedidoSelect', 'class' => 'form-control Select-Chosen', 'placeholder' => 'Ingrese el ID del pedido']) !!} 
                    <input id="PedidoId" name="pedido_id" type="text" class="Hidden"/> <br>
                    <input id="ClienteId" name="cliente_id" type="text" class="Hidden"/>
                    {!! Form::label('producto', 'Producto:') !!}
                    {!! Form::select('producto_id', $productos, null, ['class' => 'form-control  Select-Chosen', 'placeholder' => 'Ingrese el producto']) !!} 
                    {!! Form::label('cantidad', 'Cantidad:') !!}
                    {!! Form::text('cantidad', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la cantidad']) !!} 
                    {!! Form::label('valor', 'Valor:') !!}
                    {!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el valor']) !!} 
                </div>
                <div class="col-md-12 actions">
                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'animated fadeIn button buttonOk pull-right']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
	@include('vadmin.components.ajaxscripts')
@endsection

@section('custom_js')

    <script>
    	$('#PedidoSelect').on('change',function(e){
            // console.log(e)
            var clienteid = e.target.value;
            var pedidoid  = $("#PedidoSelect option:selected").html();
            $('#ClienteId').val(clienteid);
            $('#PedidoId').val(pedidoid);
            // var route = "{{ url('vadmin/show_products') }}/"+ids+"";
            // $.get(route, function(data){
            //     $('#ProductSelect').find('option').remove().end();
            //     // We add this option to put ProductSelect to work on single product result
            //     $('#ProductSelect').append("<option value=''>Seleccione una opción</option>");
            //     $.each(data, function(index, productos){
            //         $('#ProductSelect').append("<option value='"+productos.id+"' data-name='"+ productos.nombre +"' data-stockactual='"+ productos.stockactual +"'>"+ productos.nombre +"</option>");
            //     });
            //     $('#ProductSelect').trigger("chosen:updated");
            // });
        });
    </script>

@endsection