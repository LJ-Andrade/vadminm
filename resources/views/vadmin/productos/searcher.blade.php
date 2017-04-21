@section('searcher')

@if(isset($_GET['search']))
<a href="{{ url('vadmin/productos') }}"><button type="button" class="btnSmall buttonOk">Mostrar Todos</button></a>
@endif

<div class="row header-options">
    <div class="Search-Filters search-filters">
        {{-- Search --}}
        <h4 class="hide-desk">Buscador</h4>
        {!! Form::open(['id' => 'SearchForm', 'class' => 'navbar-form']) !!}
            <div class="inner-column">
                <div class="input-group">
                    {!! Form::label('id', 'Código') !!}
                    <input type="number" id="SearchById" class="form-control" placeholder="Buscar por Código..." name="id" >
    
                </div>
            </div>
            <div class="inner-column">
                <div class="input-group">
                    {!! Form::label('nombre', 'Descripción') !!}
                    {!! Form::text('nombre', null, ['id' => 'SearchByName', 'class' => 'form-control', 'placeholder' => 'Buscar por descripción...']) !!}
                </div>
            </div>
            <div class="inner-column">
                <div class="input-group">
                    {!! Form::label('', '') !!} <br>
                    <a href="{{ url('vadmin/productos') }}"><button type="button" class="btnSmall buttonOk">Mostrar Todos</button></a>
                </div>
            </div>
            
            
        {!! Form::close() !!}
        {{-- /Search --}}
        <div class="btnClose2"><i class="ion-close-round"></i></div>		
    </div>
</div>

@endsection