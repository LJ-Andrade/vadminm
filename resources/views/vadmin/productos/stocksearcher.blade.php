{{-- Search Filters --}}
<div class="row visible-searcher">
    {!! Form::open(['method' => 'GET', 'url' => 'vadmin/stock', 'class' => 'navbar-form', 'role' => 'search']) !!}
        <div class="inner">
            <div class="input-group">
                <span class="input-group-btn">
                    <input type="text" class="form-control mr" name="code" placeholder="Buscar por código...">
                    <input type="text" class="form-control" name="name" placeholder="Buscar por nombre...">
                    <button class="btn btnGreen" type="submit">
                        <i class="ion-ios-search"></i>
                    </button>
                </span>
            </div>
            <a href="{{ url('vadmin/stock?order=asc') }}"><button type="button" class="btn btnSquare btnRed">Menor Stock</button></a>
            <a href="{{ url('vadmin/stock?order=desc') }}"><button type="button" class="btn btnSquare btnGreen">Mayor Stock</button></a>
            
            @if(isset($_GET['name']))
            <div class="row search-results">
            <br>
                <div class="col-md-3 pull-right text-right pad0">
                    <a href="{{ url('vadmin/stock') }}"><button type="button" class="btnSm btnBlue">Mostrar Todo</button></a>
                </div>
                <div class="col-md-3 pad0">
                    @if($products->total() == 1)
                        <b>1</b> Resultado encontrado
                    @else
                        <b>{{ $products->total() }}</b> resultados encontrados
                    @endif
                </div>
            </div>
            @endif
        </div>
    {!! Form::close() !!}
</div>
