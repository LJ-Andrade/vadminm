@extends('vadmin.layouts.main')

@section('title', 'Vadmin | Productos')

@section('header')
	@section('header_title', 'Edición de Producto') 
	@section('options')
		<div class="actions">
			<a href="{{ url('vadmin/productos') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	    
	@endsection
@endsection

@section('styles')
	
@endsection

@section('content')
    <div class="container">
        <div class="small-form container animated fadeIn">

            {!! Form::model($producto, [
                'method' => 'PATCH',
                'url'    => ['/vadmin/productos', $producto->id],
                'class'  => 'big-form', 'data-parsley-validate' => '',
                'files'  => true
            ]) !!}
            @include('vadmin.productos.form')
            {!! Form::submit('Actualizar producto', ['class' => 'button btnGreen']) !!}
            {{-- @include ('vadmin.productos.editform', ['submitButtonText' => 'Update']) --}}

            {!! Form::close() !!}
        </div>
    </div>


@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('js/products.js') }}" ></script>
@endsection

@section('custom_js')
	<script>
    

        /////////////////////////////////////////////////
        //            SUBFAMILIAS - AJAX               //
        /////////////////////////////////////////////////


        // Check existing subfamily
        function checkFamily(){
            // var id = $('#FamiliasSelect').attr('id');
            var id = $("#FamiliasSelect option:selected").val();
            subfamilyLoad(id);
            console.log(id);
        }

        // Set existing family
        $(document).ready(function(){
            checkFamily();
        });

        // Set existing subfamily
        $('#FamiliasSelect').on('change',function(e){
            var id = e.target.value;
            subfamilyLoad(id);
        });


        function subfamilyLoad(id){
            var subfamiliaId = "{{ $subfamiliaId }}";
            var route       = "{{ url('vadmin/productos_subfamilias') }}/"+id+"";
            $.get(route, function(data){

                // Vacía el Select de OPTIONS
                $('#SubfamiliasSelect').find('option').remove().end();
                // Recorre Array de data traída por ajax
                $.each(data, function(index, subfamilias){
                    // Genera los OPTIONS correspondientes
                    if(subfamiliaId == subfamilias.id){
                        $('#SubfamiliasSelect').append("<option value='"+subfamilias.id+"' selected='selected'>"+ subfamilias.nombre +"</option>");
                    } else {
                        $('#SubfamiliasSelect').append("<option value='"+subfamilias.id+"'>"+ subfamilias.nombre +"</option>");
                    }
                });
                // Hace un update del plugin CHOSEN para que se representen los OPTIONS.
                $('#SubfamiliasSelect').trigger("chosen:updated");
            });
            
        }

        // Set Visual Prices
        
        function setDisplayPrices(){
            // Gremio
            var pjegremio   = $("#PjeGremioIpt").val();
            var preciocosto = $('#PrecioCostoIpt').val();
            var resultado   = calcPtje(preciocosto, pjegremio);
            $('#PrecioGremioDisp').val(resultado);
            // Particular
            var pjegremio   = $('#PjeParticularIpt').val();
            var preciocosto = $('#PrecioCostoIpt').val();
            var resultado   = calcPtje(preciocosto, pjegremio);
            $('#PrecioParticularDisp').val(resultado);

            // Especial
            var pjegremio   = $('#PjeEspecialIpt').val();
            var preciocosto = $('#PrecioCostoIpt').val();
            var resultado   = calcPtje(preciocosto, pjegremio);
            $('#PrecioEspecialDisp').val(resultado);
        }

        setDisplayPrices();

    </script>
@endsection