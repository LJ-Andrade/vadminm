{{-- //// SEARCH AND SET CLIENT //// --}}
<div id="ClientFinder" class="narrow-form">
    <div class="inner">
        {{-- Title --}}
        <div class="title">
            <span>Seleccionar cliente</span>
        </div>
        <div class="row">
            <div class="form-group col-md-7">
                {{-- Search By Name --}}
                {!! Form::label('cliente', 'Buscar por nombre') !!}
                {!! Form::text('cliente', null, ['id' => 'CompClientAutoComplete', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-5">
                {{-- Search By Code  --}}
                {!! Form::label('codigo', 'Buscar por código') !!}
                {!! Form::number('codigo', null, ['id' => 'CompClientByCode', 'class' => 'form-control']) !!}
            </div>
            <div class="col-md-12">
                <button id="CompGetClientByBtn" class="btnSm btnBlue"> Buscar</button>
            </div>
        </div>
    
        {{-- Output --}}
        <div id="SmallLoader"></div>
        <div id="ClientOutPut" class="Hidden">
            <div class="output-box">
                <h4><b>Cliente seleccionado:</b></h4>
                <div id="ClientData"></div>
                <div id="OutPutForm">
                    <div class="col-md-12">
                        <input type="text" name="user_id" class="Hidden" value="{{ Auth::user()->id }}">
                    </div>
                    {!! Form::text('cliente_id', null, ['id' => 'ClienteIdOutput', 'class' => 'form-control Hidden', 'required' => '']) !!} 
                    <div class="form-group">
                        <h4><b>Comprobante:</b></h4>
                        <input id="CompLetter" class="Hidden" type="text" value="">
                        <select id="TiposComp" class"Select-Chosen">
                        </select>
                    </div>
                    <button id="OpenCompBtn" class="button buttonOk">Ok</button>
                </div>
            </div>
        </div>
        <div id="ClientError" class="output-box Hidden">
            El cliente no existe
        </div>
    </div>
</div>
 		