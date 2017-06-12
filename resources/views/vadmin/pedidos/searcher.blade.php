@section('searcher')

@if(isset($_GET['show']))
<a href="{{ url('vadmin/pedidos') }}"><button type="button" class="btnSmall buttonOk">Mostrar Todos</button></a>
@endif
<div class="row header-options">
    <div class="Search-Filters search-filters">
        {{-- Search --}}
        <h4 class="hide-desk">Buscador</h4>
        {!! Form::open(['method' => 'GET', 'url' => 'vadmin/pedidos', 'class' => 'navbar-form', 'role' => 'search']) !!}
            <div class="inner-column">
                <a href="{{ url('vadmin/pedidos?show=1') }}"><button type="button" class="btn btnSquare btnRed">Pendientes</button></a>
                <a href="{{ url('vadmin/pedidos?show=2') }}"><button type="button" class="btn btnSquare btnYellow">Preparado</button></a>
                <a href="{{ url('vadmin/pedidos?show=3') }}"><button type="button" class="btn btnSquare btnGreen">Enviado</button></a>
                <a href="{{ url('vadmin/pedidos?show=5') }}"><button type="button" class="btn btnSquare btnBlue">Todos</button></a>
            </div>
        {!! Form::close() !!}
        {{-- /Search --}}
        <div class="btnClose2"><i class="ion-close-round"></i></div>		
    </div>
</div>

@endsection