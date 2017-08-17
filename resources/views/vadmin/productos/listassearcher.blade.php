{{-- Search Filters --}}
<div class="row visible-searcher">
    {!! Form::open(['method' => 'GET', 'url' => 'vadmin/listas', 'class' => 'navbar-form', 'role' => 'search']) !!}
        <div class="inner">
            {{-- <div class="">
                <div class="input-group">
                    <span class="input-group-btn">
                        <input type="text" class="form-control mr" name="code" placeholder="Buscar por código...">
                        <input type="text" class="form-control" name="name" placeholder="Buscar por nombre...">
                        <button class="btn btn-default mr" type="submit">
                            <i class="ion-ios-search"></i>
                        </button>
                    </span>
                </div>
                <a href="{{ url('vadmin/listas?order=asc') }}"><button type="button" class="btn btnSquare btnBlue"><i class="ion-arrow-up-c"></i></button></a>
                <a href="{{ url('vadmin/listas?order=desc') }}"><button type="button" class="btn btnSquare btnBlue"><i class="ion-arrow-down-c"></i></button></a>
                @if(isset($_GET['name']) or isset($_GET['code']))
                    <a href="{{ url('vadmin/stock') }}"><button type="button" class="btn btnSquare btnBlue">Mostrar Todos</button></a> <br>
                    {{ $searchMessage }}
                @endif
            </div> --}}
            <div class="row inner-box">
                <div>
                    <b>Familias</b> <br>
                    <div class="checkbox">
                        @foreach($familias as $familia)
                            <label><input type="checkbox" name="familias" value="{{ $familia->id }}">{{ $familia->nombre }}</label>  <br>   
                        @endforeach
                            <label><input type="checkbox" name="familias" value="">Todas</label>  <br>  
                    {{--   @foreach($subfamilias as $subfamilia)
                            <label><input type="checkbox" value="">{{ $subfamilia->nombre }}</label> <br>
                        @endforeach
                        --}}
                    </div>
                </div>
                <div>
                    <b>Tipo de Cliente</b> <br>
                    <div class="radio">
                        @foreach($tiposcte as $tipocte)
                            <label><input type="radio" name="tipocte" value="{{ $tipocte->id }}" required="">{{ $tipocte->name }}</label>
                        @endforeach
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btnSquare btnBlue">Generar Lista</button>
                    
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    {!! Form::close() !!}
</div>
