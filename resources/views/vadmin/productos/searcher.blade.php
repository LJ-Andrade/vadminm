@section('searcher')

<div class="row header-options">
    <div class="Search-Filters search-filters">
        {{-- Search --}}
        <h4 class="hide-desk">Buscador</h4>
        {!! Form::open(['method' => 'GET', 'url' => 'vadmin/productos', 'class' => 'navbar-form', 'role' => 'search']) !!}
            <div class="inner-column">
                <div class="input-group">
                    <span class="input-group-btn">
                        <input type="text" class="form-control" name="name" placeholder="Buscar por descripción...">
                    </span>
                </div>

                 <div class="input-group">
                    <span class="input-group-btn">
                    <input type="text" class="form-control" name="code" placeholder="Buscar por código...">
                        <button class="btn btnGreen" type="submit">
                            <i class="ion-ios-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        {!! Form::close() !!}
        {{-- /Search --}}
        <div class="btnClose2"><i class="ion-close-round"></i></div>		
    </div>
</div>
@if(isset($_GET['name']) or isset($_GET['code']))
<div class="row search-results">
    <div class="col-md-3 pull-right text-right pad0">
        <a href="{{ url('vadmin/productos') }}"><button type="button" class="btnSm btnBlue">Mostrar Todos</button></a>
    </div>
    <div class="col-md-3 pad0">
        @if($productos->total() == 1)
            <b>1</b> Resultado encontrado
        @else
            <b>{{ $productos->total() }}</b> resultados encontrados
        @endif
    </div>
</div>
@endif

@endsection