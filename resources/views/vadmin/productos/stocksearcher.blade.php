{{-- Search Filters --}}
<div class="row visible-searcher">
    {!! Form::open(['method' => 'GET', 'url' => 'vadmin/stock', 'class' => 'navbar-form', 'role' => 'search']) !!}
        <div class="inner">
            <div class="input-group">
                <span class="input-group-btn">
                    <input type="text" class="form-control mr" name="code" placeholder="Buscar por código...">
                    <input type="text" class="form-control" name="name" placeholder="Buscar por nombre...">
                    <button class="btn btn-default mr" type="submit">
                        <i class="ion-ios-search"></i>
                    </button>
                </span>
            </div>
            <a href="{{ url('vadmin/stock?order=asc') }}"><button type="button" class="btn btnSquare btnRed">Menor Stock</button></a>
            <a href="{{ url('vadmin/stock?order=desc') }}"><button type="button" class="btn btnSquare btnGreen">Mayor Stock</button></a>
            @if(isset($_GET['name']) or isset($_GET['code']))
                <a href="{{ url('vadmin/stock') }}"><button type="button" class="btn btnSquare btnBlue">Mostrar Todos</button></a> <br>
                {{ $searchMessage }}
                @endif
        </div>
    {!! Form::close() !!}
</div>
