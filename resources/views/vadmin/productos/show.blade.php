
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
		<div class="row big-card">	
            <div class="title">
                <p>{{ $producto->familia->nombre }} > {{ $producto->subfamilia->nombre }}</p>
			    <span class="title">{{ $producto->nombre }}</h1>
                <p class="small">Cód. {{ $fullid }}</p>
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
                      <div class="col-md-4">
                        <div class="subtitle">Stock </div>
                        <b>Stock actual:</b> 
                        @if ( $producto->stockactual < $producto->stockmin )
                        <span class="badge buttonCancel"> {{ $producto->stockactual }} </span>
                        @else {{ $producto->stockactual }} @endif <br>
                        <b>Stock mínimo:</b> {{ $producto->stockmin }} <br>
                        <b>Stock máximo:</b> {{ $producto->stockmax }} <br>
                        {{-- Update Stock Modal Trigger --}}
                        <button class="btnSm buttonOther" data-toggle="modal" data-target="#UpdateStockModal">Actualizar Stock</button>
                    </div>
                    <div class="col-md-4">
                        <div class="subtitle">Datos</div>
                        <b>Código: </b>  {{ $fullid }} <br>
                        <b>Familia: </b>  @if(is_null($producto->familia->nombre)) @else {{ $producto->familia->nombre }} @endif <br>
                        <b>Subfamilia: </b>  @if(is_null($producto->subfamilia->nombre)) @else {{ $producto->subfamilia->nombre }} @endif <br>
                    </div>
                    <div class="col-md-4">
                        <div class="subtitle">Proveedor</div>
                        <b>Proveedor:</b> @if(is_null($producto->proveedor->nombre)) @else {{ $producto->proveedor->nombre }} @endif <br>
                        <b>Código de proveedor:</b> @if(is_null($producto->codproveedor)) @else {{ $producto->codproveedor }} @endif  <br>
                        <b>Condición de iva:</b> @if(is_null($producto->condiva)) @else {{ $producto->condiva }} %@endif <br>
                    </div>
                </div>
                <hr class="softhr">
                <div class="row">
                    <div class="col-md-4">
                        <div class="subtitle">Precios en Dólares</div>
                        <b>Precio de costo: u$s</b> @if(is_null($producto->preciocosto)) @else {{ $producto->preciocosto }} @endif <br>
                        <b>Gremio</b> @if(is_null($producto->pjegremio)) @else {{ $producto->pjegremio }} % @endif | <b>u$s</b> {{ $valgremiouss }} <br>
                        <b>Particular:</b> @if(is_null($producto->pjeparticular)) @else {{ $producto->pjeparticular }} % @endif | <b>u$s: </b>{{ $valparticularuss }} <br>
                        <b>Especial:</b> @if(is_null($producto->pjeespecial)) @else {{ $producto->pjeespecial }} % @endif | <b>u$s</b> {{ $valespecialuss }} </b><br>                
                        {{-- Update Price Modal Trigger --}}
                        <button class="btnSm buttonOther" data-toggle="modal" data-target="#UpdatePriceModal">Actualizar Costo</button>
                    </div>
                    <div class="col-md-4">
                        <div class="subtitle">Precios en Pesos</div>
                        <b>Precio de costo: $</b> {{ $preciocostopesos }} <br>
                        <b>Gremio</b> @if(is_null($producto->pjegremio)) @else {{ $producto->pjegremio }} % @endif | <b>$</b> {{ $valorgremio }} <br>
                        <b>Particular:</b> @if(is_null($producto->pjeparticular)) @else {{ $producto->pjeparticular }} % @endif | <b>$ </b>{{ $valorparticular }} <br>
                        <b>Especial:</b> @if(is_null($producto->pjeespecial)) @else {{ $producto->pjeespecial }} % @endif | <b>$</b> {{ $valorespecial }} </b><br>
                    </div>
                     <div class="col-md-4">
                        <div class="subtitle">Precios en Pesos</div>
                        <b>Precio de costo: $</b> {{ $preciocostopesos }} <br>
                        <b>Gremio</b> @if(is_null($producto->pjegremio)) @else {{ $producto->pjegremio }} % @endif | <b>$</b> {{ $valorgremio }} <br>
                        <b>Particular:</b> @if(is_null($producto->pjeparticular)) @else {{ $producto->pjeparticular }} % @endif | <b>$ </b>{{ $valorparticular }} <br>
                        <b>Especial:</b> @if(is_null($producto->pjeespecial)) @else {{ $producto->pjeespecial }} % @endif | <b>$</b> {{ $valorespecial }} </b><br>
                    </div>
                </div>
                <div class="row">
                  
                    <div class="col-md-6">
                        <div class="subtitle">Ofertas</div>
                        <b>Precio de oferta:</b> @if(is_null($producto->preciooferta)) @else u$s {{ $producto->preciooferta }} @endif | @if(is_null($precioofertapesos)) @else $ {{ $precioofertapesos }} @endif <br>
                        <b>Cantidad mínima (oferta):</b> @if(is_null($producto->cantoferta)) @else {{ $producto->cantoferta }} @endif <br>
                    </div>
                </div>
                <hr class="softhr">
			</div> {{-- /Content --}}
                    
            <div class="right-bottom">
                <span class="small-text">Última actualización: <b>{{ transDateT($producto->updated_at) }}</b></span><br>
                <a href="{{ url('vadmin/productos/' . $producto->id . '/edit') }}" data-id="{{ $producto->id }}">
                    <button class="btnSm buttonOk">Editar Producto</button> 
                </a>
            </div>
		</div> {{-- /Row Big-Card --}}
	</div> {{-- /Container --}}
	<div id="Error"></div>	

        {{-- Stock Update Modal --}}
    	@component('vadmin.components.modal')
            @slot('id', 'UpdateStockModal')
            @slot('title', 'Actualización de Stock')
            @slot('content')
                {!! Form::open(['method' => 'POST', 'id' => 'UpdateStockForm', 'class' => '', 'data-parsley-validate' => '']) !!}	
                    {!! Form::label('stock', 'Stock:') !!}	
                    {!! Form::text('stock', $producto->stockactual, ['id' => 'NewStock', 'class' => 'form-control']) !!}
                {!! Form::close() !!}
            @endslot
            @slot('ok_button')
                <button id="UpdateStockBtn" class="button buttonOk">Actualizar</button>
            @endslot
	    @endcomponent

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
    <script type="text/javascript" src="{{ asset('js/products.js') }}" ></script>
@endsection

@section('custom_js')
    <script>	

        /////////////////////////////////////////////////
		//            UPDATE STOCK - AJAX              //
		/////////////////////////////////////////////////

        $("#UpdateStockForm").on("submit", function (e) {
            e.preventDefault();
            $('#UpdateStockBtn').click();
        });

        $('#UpdateStockBtn').on('click',function(){
            var id      = "{{  $producto->id  }}";
            var value   = $('#NewStock').val();
            var route   = "{{ url('vadmin/update_prod_stock') }}/"+id+"";
            var success = location.reload();
            updateProduct(route, id, value, success);
        });
        
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