
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Productos')

{{-- HEAD--}}
@section('header')
	@section('header_title')
		Hoja de Producto
    @endsection 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/productos') }}" class="btn btnSm buttonOther">Volver</a>
		</div>	
	@endsection
@endsection

{{-- STYLES--}}
@section('styles')
	{{-- Include Styles Here --}}
@endsection
@component('vadmin.components.mainloader')@endcomponent
{{-- CONTENT --}}
@section('content')
    <div class="container">
        <div id="Error"></div>
		<input type="text" id="Operacion" class="Hidden" value="producto">{{-- This shows product data display--}}
		<div class="row big-card">	
            <div class="title">
                <span class="medium-text">{{ $producto->familia->nombre }} > {{ $producto->subfamilia->nombre }}</span> <br>
			    <span class="big-text">{{ $producto->nombre }}</span><br>
                <span class="small-text">Cód. {{ $producto->id }}</span>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        {{-- Status --}}
                        <div class="status">
                            @if ($producto->estado == 'activo')
                                <span class="text"><i class="ion-record active"></i> <b>Estado:</b> En Lista</span> <br>
                                <button class="UpdateStatusBtn btnXSmall buttonCancel" data-action="pausar" data-id="{!! $producto->id !!}">
                                Pausar
                            @elseif ($producto->estado == 'pausado')
                                <span class="text"><i class="ion-record paused"></i> <b>Estado:</b> Sin Listar</span> <br>
                                <button class="UpdateStatusBtn btnXSmall buttonOk" data-action="activar" data-id="{!! $producto->id !!}">
                                Activar
                            @else 
                                <span class="text"><i class="ion-record paused"></i> <b>Estado:</b> Indefinido</span> <br>
                                <button class="UpdateStatusBtn btnXSmall buttonOk"  data-action="activar" data-id="{!! $producto->id !!}">
                                Activar
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="subtitle">Stock </div>
                        <b>Stock mínimo:</b> {{ $producto->stockmin }} |
                        <b>Stock máximo:</b> {{ $producto->stockmax }} 
                        <br>
                        <b>Stock Depósito:</b> 
                        @if ( $producto->stockactual < $producto->stockmin )
                        <span class="badge buttonCancel"> {{ $producto->stockactual }} </span>
                        @else {{ $producto->stockactual }} @endif <br>
                    
                        <b>Stock Local:</b> 
                        @if ( $producto->stocklocal < $producto->stockmin )
                        <span class="badge buttonCancel"> {{ $producto->stocklocal }} </span>
                        @else {{ $producto->stocklocal }} @endif <br>
                        
                        <hr class="softhr">
                        {{-- Update Stock --}}
                        <b>Modificar Stock</b>
                        <div class="form-group">
                            <div class="col-md-3">
                                {!! Form::label('sumstock', 'Depósito') !!}
                                {!! Form::number('sumstock', null, ['id' => 'SumStock', 'class' => 'form-control', 'data-productid' => $producto->id]) !!}
                            </div>
                            <br>
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="UpdateStockBtn" class="btn btnBlue">Actualizar</button>
                        </div>
                        {{-- /Update Stock --}}
                    </div>
                    <div class="col-md-6">
                        <div class="subtitle">Proveedor</div>
                        <b>Proveedor:</b> @if(is_null($producto->proveedor->nombre)) @else {{ $producto->proveedor->nombre }} @endif <br>
                        <b>Código de proveedor:</b> @if(is_null($producto->codproveedor)) @else {{ $producto->codproveedor }} @endif  <br>
                        <b>Condición de iva:</b> @if(is_null($producto->condiva)) @else {{ $producto->condiva }} %@endif <br>
                    </div>
                </div>
                <hr class="softhr">
                <div class="row">
                    <div class="col-md-6">
                        {{-- Update Cost and Currency--}}
                        <div class="subtitle">Precio de Costo</div>
                        {!! Form::open(['method' => 'POST', 'id' => 'UpdatePriceForm', 'class' => '', 'data-parsley-validate' => '']) !!}
                            <div class="form-group col-md-6">
                                {!! Form::label('monedacompra', 'Moneda de Compra') !!}	
                                {!! Form::select('monedacompra', $monedas, $producto->monedacompra, ['id' => 'NewCurrency', 'class' => 'form-control Selech-Chosen']) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('preciocosto', 'Costo:') !!}	
                                {!! Form::text('preciocosto', $valorcompra, ['id' => 'NewPrice', 'class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <button id="UpdatePriceBtn" class="btnSm buttonOther">Actualizar Costo</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6">
                        <div class="subtitle">Precios en Pesos</div>
                        <table class="col-md-6 small-table">
                            <tr>
                                <td><b>Gremio</b> {{ $producto->pjegremio }} % </td>
                                <td><b>$</b> {{ $finalgremio }} </td>                            
                            </tr>
                            <tr>
                                <td><b>Particular:</b> {{ $producto->pjeparticular }} % </td>
                                <td><b>$ </b>{{ $finalparticular }} </td>
                            </tr>
                        </table>
                        <table class="col-md-6 small-table">
                            <tr>
                                <td><b>Especial: </b> {{ $producto->pjeespecial }} % </td>
                                <td><b>$</b> {{ $finalespecial }} </b><br></td>
                            </tr>
                       
                        </table>
                    </div>
                    @if($producto->oferta == 'on')
                    <div class="col-md-6">
                        <hr class="softhr">
                        <b>Oferta</b> ({{ $producto->pjeoferta }} %): <b>$</b> {{ $finaloferta }} </b><br>
                        Cantidad mínima: {{$producto->cantoferta }}
                    </div>
                    @else
                    @endif

                </div>
                <hr class="softhr">
			</div> {{-- /Content --}}
            <div class="row sect-footer">
                <div class="right-bottom">
                    <span class="small-text">Última actualización: <b>{{ transDateT($producto->updated_at) }}</b></span><br>
                    <a href="{{ url('vadmin/productos/' . $producto->id . '/edit') }}" data-id="{{ $producto->id }}">
                        <button class="btnSm buttonOk">Editar Producto</button> 
                    </a>
                </div>
            </div>
		</div> {{-- /Row Big-Card --}}
	</div> {{-- /Container --}}
    <div id="Error"></div>
@endsection

@section('scripts')
	@include('vadmin.components.ajaxscripts')
    <script type="text/javascript" src="{{ asset('js/products.js') }}" ></script>
@endsection

@section('custom_js')
    <script>	


        /////////////////////////////////////////////////
		//            UPDATE PRICE - AJAX              //
		/////////////////////////////////////////////////

        $("#UpdatePriceForm").on("submit", function (e) {
            e.preventDefault();
            $('#UpdatePriceBtn').click();
        });

        $('#UpdatePriceBtn').on('click',function(){
            var id       = "{{  $producto->id  }}";
            var price    = $('#NewPrice').val();
            var currency = $('#NewCurrency option:selected').val();
            var data     = {id: id,  price: price, currency: currency};

            var route    = "{{ url('vadmin/updateCurrencyAndPrice') }}";
            var success  = reloadPage();
            updateCurrencyAndPrice(route, id, data, success);
        });

        /////////////////////////////////////////////////
		//            UPDATE STATUS - AJAX             //
		/////////////////////////////////////////////////

        $(document).on('click', '.UpdateStatusBtn', function(e) { 
            
            var id     = $(this).data('id');
            var route  = "{{ url('/vadmin/update_prod_status') }}/"+id+"";
            var action = $(this).data('action');
            console.log(id);
            updateProductStatus(route, action);
            
        });

    </script>
@endsection