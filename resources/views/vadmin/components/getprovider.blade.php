<div class="container">
	<div class="row">
		<div class="narrow-form">
			<div class="inner">
				{{-- Title --}}
				<div class="title">
					<span>Buscar Proveedor</span>
				</div>
				<div class="row content">
                    <div class="form-group col-md-7">
                        {{-- Search By Name --}}
                        {!! Form::label('cliente', 'Buscar por nombre') !!}
                        {!! Form::text('cliente', null, ['id' => 'ProviderAutoComplete', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-md-5">
                        {{-- Search By Code  --}}
                        {!! Form::label('codigo', 'Buscar por código') !!}
                        {!! Form::number('codigo', null, ['id' => 'ProviderByCode', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-12">
                        <button id="ProviderByCodeBtn" class="btnSm btnBlue"> Buscar</button>
                    </div>
                </div>
				<div class="clearfix"></div>
				{{-- Output --}}
				<div id="SmallLoader"></div>
				<div id="ProviderOutPut" class="Hidden">
					<div class="output-box">
						<h4>Proveedor seleccionado:</h4>
						<div id="ProviderData"></div>
						<div id="OutPutForm">					
                            <div class="col-md-12">
                                <input type="text" name="user_id" class="Hidden" value="{{ Auth::user()->id }}">
                            </div>
                            {!! Form::text('cliente_id', null, ['id' => 'ProviderIdOutput', 'class' => 'form-control Hidden', 'required' => '']) !!} 
						</div>
					</div>
				</div>
				<div id="ProviderError" class="output-box Hidden">
					El proveedor no existe
				</div>
			</div> {{-- / inner --}}
		</div>  {{-- / narrow form  --}}
	</div> 	{{-- / row  --}}
</div>  {{-- / container  --}}
