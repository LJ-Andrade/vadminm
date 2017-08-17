@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Listas de Precios')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Listos de Precios') 
	@section('options')
	@endsection
@endsection

{{-- STYLES--}}
@section('styles')
	{{-- Include Styles Here --}}
@endsection

{{-- CONTENT --}}
@section('content')
	<div class="container">
		@include('vadmin.productos.listassearcher')
        {{-- Export Links --}}
        <br>
        @if(isset($_GET['familias']) &&  isset($_GET['tipocte']))
            <a href="exportPricesListPdf/{{ $_GET['familias'] }}/{{ $_GET['tipocte'] }}" type="submit" class="btn btnSquare btnRed" target="_blank"><i class="ion-ios-cloud-download-outline"></i> Exportar a PDF</a>
            <a href="exportPricesListExcel/{{ $_GET['familias'] }}/{{ $_GET['tipocte'] }}" type="submit" class="btn btnSquare btnGreen" target="_blank"><i class="ion-ios-cloud-download-outline"></i> Exportar a Excel</a>
            @elseif(isset($_GET['tipocte']))
            <a href="exportPricesListPdf/X/{{ $_GET['tipocte'] }}" type="submit" class="btn btnSquare btnRed" target="_blank"><i class="ion-ios-cloud-download-outline"></i> Exportar a PDF</a>
            <a href="exportPricesListExcel/X/{{ $_GET['tipocte'] }}" type="submit" class="btn btnSquare btnGreen" target="_blank"><i class="ion-ios-cloud-download-outline"></i> Exportar a Excel</a>
            @else
        @endif
        {{-- List Type Title --}}
		<div class="row">
            @if(isset($_GET['tipocte']))
                @if($_GET['tipocte'] == '1')
                    <div class="horiz-title"><b>Lista Gremio</b></div>
                @elseif($_GET['tipocte'] == '2')
                    <div class="horiz-title"><b>Lista Particulares</b></div>
                @elseif($_GET['tipocte'] == '3')
                    <div class="horiz-title"><b>Lista Especial</b></div>
                @elseif($_GET['tipocte'] == '4')
                    <div class="horiz-title"><b>Lista Oferta</b></div>
                @else
                    
                @endif
            @endif
            {{-- List --}}
			@include('vadmin.productos.listaslist')
		</div>
	</div>
    <div id="Error"></div>
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
@endsection

@section('custom_js')

	<script type="text/javascript">

        // $('#ExportPdfBtn').click(function(e){
        //     e.preventDefault();
        //     var familia = $(this).data('familia');
        //     var tipocte = $(this).data('tipocte');
        //     var route  = "{{ url('vadmin/exportPricesListPdf') }}";
        //     console.log('ok');
        //     $.ajax({	
        //         url: route,
        //         method: 'POST',             
        //         dataType: 'JSON',
        //         data: { familia: familia, tipocte: tipocte},
        //         success: function(data){
        //             console.log(data);
        //         },
        //         error: function(data)
        //         {
        //             console.log(data);
        //             $('#Error').html(data.responseText);
        //         },
        //     });


        // });

    </script>

@endsection