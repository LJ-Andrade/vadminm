
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
{{-- CONTENT --}}
@section('content')
    <div class="container">
        <div id="Error"></div>
		<input type="text" id="Operacion" class="Hidden" value="producto">{{-- This shows product data display--}}
		<div class="row big-card">	
            <div class="title">
                <span class="medium-text">{{ $producto->familia->nombre }} > {{ $producto->subfamilia->nombre }}</span> <br>
			    <span class="big-text">{{ $producto->nombre }}</span><br>
                <span class="small-text">Cód. {{ $fullid }}</span>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        {{-- Status --}}
                        <div class="UpdateStatusBtn status" data-id="{!! $producto->id !!}">
                            @if ($producto->estado == 'activo')
                                <span class="text"><i class="ion-record active"></i> <b>Estado:</b> En Lista</span> <br>
                                <button id="UpdateStatusBtn{{$producto->id}}" data-switchstatus="pausado" class="btnXSmall buttonCancel">
                                Pausar
                            @elseif ($producto->estado == 'pausado')
                                <span class="text"><i class="ion-record paused"></i> <b>Estado:</b> Sin Listar</span> <br>
                                <button id="UpdateStatusBtn{{$producto->id}}" data-switchstatus="activo" class="btnXSmall buttonOk">
                                Activar
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="subtitle">Stock </div>
                        <b>Stock actual:</b> 
                        @if ( $producto->stockactual < $producto->stockmin )
                        <span class="badge buttonCancel"> {{ $producto->stockactual }} </span>
                        @else {{ $producto->stockactual }} @endif <br>
                        <b>Stock mínimo:</b> {{ $producto->stockmin }} |
                        <b>Stock máximo:</b> {{ $producto->stockmax }} <br>

                        {{-- Update Stock --}}
                        <div class="form-group">
                            <div class="col-md-3">
                                {!! Form::label('sumstock', 'Cantidad') !!}
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
                    <div class="col-md-4">
                        <div class="subtitle">Precio de Costo</div>
                        <b>Moneda:</b>  {{ $monedacompra->nombre }}<br>
                        <b>Valor: </b>  {{ $valorcompra }}<br>
                        {{-- Update Price Modal Trigger --}}
                        <button class="btnSm buttonOther" data-toggle="modal" data-target="#UpdatePriceModal">Actualizar Costo</button>
                    </div>
                    <div class="col-md-4">
                        <div class="subtitle">Precios en Pesos</div>
                        <table class="small-table">
                            <tr>
                                <td><b>Gremio</b> {{ $producto->pjegremio }} % </td>
                                <td><b>$</b> {{ $finalgremio }} </td>                            
                            </tr>
                            <tr>
                                <td><b>Particular:</b> {{ $producto->pjeparticular }} % </td>
                                <td><b>$ </b>{{ $finalparticular }} </td>
                            </tr>
                            <tr>
                                <td><b>Especial: </b> {{ $producto->pjeespecial }} % </td>
                                <td><b>$</b> {{ $finalespecial }} </b><br></td>
                            </tr>
                        </table>
                    </div>
  
                    <div class="col-md-4">
                        <div class="subtitle">Precio de oferta  (pesos) </div>
                        <b>Precio de oferta:</b> @if(is_null($producto->preciooferta)) @else $ {{ $producto->preciooferta }} @endif <br>
                        <b>Cantidad mínima:</b> @if(is_null($producto->cantoferta)) @else {{ $producto->cantoferta }} @endif <br>
                    </div>
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


    {{-- Price Update Modal --}}
    @component('vadmin.components.modal')
        
        @slot('id', 'UpdatePriceModal')
                
        @slot('title', 'Actualización de Costo')
        
        @slot('content')
            {!! Form::open(['method' => 'POST', 'id' => 'UpdatePriceForm', 'class' => '', 'data-parsley-validate' => '']) !!}	
                {!! Form::label('preciocosto', 'Costo:') !!}	
                {!! Form::text('preciocosto', $producto->preciocosto, ['id' => 'NewPrice', 'class' => 'form-control']) !!}
            {!! Form::close() !!}
        @endslot
        
        @slot('ok_button')
            <button id="UpdatePriceBtn" class="button buttonOk">Actualizar</button>
        @endslot

    @endcomponent


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
            var id      = "{{  $producto->id  }}";
            var data    = $('#NewPrice').val();
            var route   = "{{ url('vadmin/update_prod_costprice') }}/"+id+"";
            var success = location.reload(); 
            updateProduct(route, id, data, success);
        });

        /////////////////////////////////////////////////
		//            UPDATE STATUS - AJAX             //
		/////////////////////////////////////////////////

        $(document).on('click', '.UpdateStatusBtn', function(e) { 

            var id           = $(this).data('id');
            var route        = "{{ url('/vadmin/update_prod_status') }}/"+id+"";
            var statusBtn    = $('#UpdateStatusBtn'+id);
            var switchstatus = statusBtn.data('switchstatus');
            var statusBtn    = $(this).children();	

            $.ajax({
                url: route,
                method: 'post',             
                dataType: 'json',
                data: { id: id, estado: switchstatus
                },
                success: function(data){
                    var updatedStatus = (data.lastStatus);
                    var iconStatus    = '';
                    location.reload();  
                },
                complete: function(data){
                    toggleLoader();
                },
                error: function(data)
                {
                    console.log(data);
                    // $('#Error').html(data.responseText);
                },
            });
        });
    </script>
@endsection