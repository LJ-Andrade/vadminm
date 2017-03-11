<div class="row header-options">
    <div class="Search-Filters search-filters">
        {{-- Search --}}
        <h4 class="hide-desk">Buscador</h4>
        {!! Form::open(['id' => 'SearchForm', 'class' => 'navbar-form']) !!}
            <div class="inner-column">
                <div class="input-group">
                    {!! Form::label('name', 'Nombre o Email') !!}
                    {!! Form::text('query', null, ['id' => 'SearchInput', 'class' => 'form-control', 'placeholder' => 'Buscar por nombre o email...', 'aria-describedby' => 'search']) !!}
                </div>
            </div>
            <div class="inner-column">
                <div class="input-group">
                    {!! Form::label('type', 'Rol') !!}
                    {!! Form::select('type', ['*' => 'Todos', 'user' => 'Usuario','admin' => 'Admin', 'superadmin' => 'SuperAdmin'], null, ['id' => 'SearchRole', 'class' => 'form-control', 'placeholder' => 'Rol']) !!}
                </div>
            </div>
        {!! Form::close() !!}
        {{-- /Search --}}
        <div class="btnClose"><i class="ion-close-round"></i></div>		
    </div>
</div>

