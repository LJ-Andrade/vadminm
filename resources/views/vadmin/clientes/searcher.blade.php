@section('searcher')

@if(isset($_GET['name']) or isset($_GET['code']))
<a href="{{ url('vadmin/clientes') }}"><button type="button" class="btnSmall buttonOk">Mostrar Todos</button></a> <br><br>
Resultados de la búsqueda:
@endif
<div class="row header-options">
    <div class="Search-Filters search-filters">
        {{-- Search --}}
        <h4 class="hide-desk">Buscador</h4>
        {!! Form::open(['method' => 'GET', 'url' => 'vadmin/clientes', 'class' => 'navbar-form', 'role' => 'search']) !!}
            <div class="inner-column">
                <div class="input-group">
                    <span class="input-group-btn">
                        <input type="text" class="form-control" name="name" placeholder="Buscar por razón social...">
                    </span>
                </div>
                 <div class="input-group">
                    <span class="input-group-btn">
                        <input type="text" class="form-control" name="code" placeholder="Buscar por código...">
                        <button class="btn btn-default" type="submit">
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

@endsection