@extends('web.layouts.main')
@section('title', 'FASCINATION | Contacto')

@section('styles')
    

@endsection


@section('content')
    	
    @include('web.layouts.partials.contact')
    @include('web.layouts.partials.foot')

@endsection

@section('scripts')


@endsection

@section('custom_js')

	<script type="text/javascript">
		
		$('body').addClass('contact-background');

	</script>

@endsection