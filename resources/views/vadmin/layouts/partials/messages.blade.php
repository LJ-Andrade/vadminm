{{-- Message --}}
@if(Session::has('message'))
	<div class="alert alert-success"> 
    	<i class="fa fa-star"></i> {{ Session::get('message') }}
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
    </div> 
@endif
