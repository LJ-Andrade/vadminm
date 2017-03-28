@extends('vadmin.layouts.main')
@section('title', 'Vadmin | Mataderos Distribuciones')
@section('header_title', 'Vendedores')
@section('header_subtitle')
	
@endsection

@section('content')

	 <div class="container">
		<div class="row">
		
			 <div class="col-md-12 animated fadeIn main-list">
                @foreach($vendedores as $vendedor)
                <div class="AnotherSection row item-row simple-list">
                    {{-- Column / Image --}}
                    <div class=""></div>

                    <div class="content">
                        {{-- Column --}}
                        <div class="col-xs-6 col-sm-4 col-md-4 inner">
                            {{ $vendedor->name }}
                        </div>
                        {{-- Column --}}
                        <div class="col-xs-6 col-sm-3 col-md-4 mobile-hide inner-tags">
                        </div>                        
                    </div>
   
                </div>

                @endforeach

                {{-- If there is no articles published shows this --}}
                @if(! count($vendedores))
                <div class="Item-Row item-row empty-row">
                    No se han encontrado items
                </div>
                @endif
            </div>
		</div>
	 </div>  

@endsection

@section('custom_js')

	<script>
	
    $('.AnotherSection').click(function(){
        alert_info("", "Los vendedores se crean y editan desde la sección 'Usuarios' </a>");
        '{{ url('vadmin/ajax_list_users') }}'
    })
	
	</script>
@endsection






