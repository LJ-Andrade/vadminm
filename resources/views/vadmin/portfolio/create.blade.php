@extends('vadmin.layouts.main')
@section('title', 'VADmin | Nuevo Artículo')


@section('header')
	@section('header_title', 'Nuevo Artículo') 
	@section('header_subtitle', ' ')
	@section('options')
		<div class="actions">
			<a href="{{ route('portfolio.index') }}"><button type="button" class="animated fadeIn btnSm buttonOther">Volver</button></a>
		</div>	
	@endsection
@endsection



@section('styles')
	{!! Html::style('plugins/texteditor/trumbowyg.min.css') !!}
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}
@endsection

@section('content')

	<div class="container">
	    <div class="row">
	        {!! Form::open(['route' => 'portfolio.store', 'method' => 'POST', 'files' => true, 'id' => 'NewItemForm', 'class' => 'big-form', 'data-parsley-validate' => '']) !!}	
				<div class="row">
					{{-- Title --}}
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('title', 'Título') !!}
							{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Título del artículo', 'id' => 'TitleInput', 
							'required' => '', 'maxlength' => '120', 'minlength' => '4']) !!}
						</div>
					</div>
					{{-- Slug --}}
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('slug', 'Url - Dirección web') !!}
							{!! Form::text('slug', null, ['class' => 'SlugInput form-control', 'placeholder' => 'Dirección visible (en explorador)', 'id' => 'SlugInput', 'required' => '']) !!}
							<div class="slug2"></div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				{{-- Content --}}
				<div class="form-group">
					{!! Form::label('content', 'Contenido') !!}
					{!! Form::textarea('content', null, ['class' => 'form-control Textarea-Editor']) !!}
				</div>
				<div class="row">
					{{-- Category --}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('category_id', 'Categoría') !!}
							{!! Form::select('category_id', $categories, null, ['class' => 'form-control Select-Category', 'placeholder' => 'Seleccione una opcion',
							'required' => '']) !!}
						</div>
					</div>
					{{-- Tags--}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('tags', 'Tags') !!}
							{!! Form::select('tags[]',$tags, null, ['class' => 'form-control Select-Tags', 'multiple', 'required' => '']) !!}
						</div>
					</div>
					{{-- Status--}}
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('status', 'Estado') !!}
							{!! Form::select('status', ['active' => 'Activo','paused' => 'Pausado'], null, ['class' => 'form-control']) !!}
						</div>
					</div>	
				</div>
				{{-- Images--}}
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							{!! Form::label('images', 'Imágenes') !!}
							<span style="font-size: 12px"> | Formatos soportados: jpeg, jpg, png, gif</span>
							{!! Form::file('images[]', array('multiple'=>true, 'id' => 'Multi_Images')) !!}
							<div class="ErrorImage"></div>
						</div>
						<hr class="softhr">
					</div>
				</div>
				<div class="row text-center">
					{!! Form::submit('Agregar artículo', ['class' => 'button buttonOk']) !!}
				</div>
			{!! Form::close() !!}
	    </div>
	</div>  

@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/texteditor/trumbowyg.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	<script type="text/javascript" src="{{ asset('js/jslocal/forms.js') }}" ></script>
@endsection

@section('custom_js')
	
	<script>

		// ------------------- Textarea Text Editor --------------------------- //
		// Path to icons
		$.trumbowyg.svgPath = '{{ asset('plugins/texteditor/icons.svg') }}';
		// Init
		$('.Textarea-Editor').trumbowyg();

		// ----------------------- Color Picker --------------------------------//
		// Add Color Selector
		$(".ColorPicker").spectrum({
			
			color: "#fff",
			change: function(color) {
				// var div = ;
				var hex = color.toHexString(); // #ff0000
				// alert(div);
				$('.ColorPickerList').append("<div class='picked-color' style='background-color:"+ hex +"'><input type='hidden' name='color[]' value='"+ hex +"'></div>");
				console.log(hex);
			}
		});

	</script>

@endsection


