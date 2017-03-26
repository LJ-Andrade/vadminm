@section('searcher')

@if(isset($_GET['search']))
<a href="{{ url('vadmin/clientes') }}"><button type="button" class="btnSmall buttonOk">Mostrar Todos</button></a>
@endif

<div class="row header-options">
    <div class="Search-Filters search-filters">
        {{-- Search --}}
        <h4 class="hide-desk">Buscador</h4>
        {!! Form::open(['id' => 'SearchForm', 'class' => 'navbar-form']) !!}
            <div class="inner-column">
                <div class="input-group">
                    {!! Form::label('id', 'Código') !!}
                    <input type="number" id="SearchById" class="form-control" placeholder="Buscar por nombre o email..." name="id" >
    
                </div>
            </div>
            <div class="inner-column">
                <div class="input-group">
                    {!! Form::label('name', 'Razón Social') !!}
                    {!! Form::text('name', null, ['id' => 'SearchByName', 'class' => 'form-control', 'placeholder' => 'Buscar por nombre o email...']) !!}
                </div>
            </div>
            
        {!! Form::close() !!}
        {{-- /Search --}}
        <div class="btnClose2"><i class="ion-close-round"></i></div>		
    </div>
</div>

@endsection