
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Clientes')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Mapa de Desarrollo') 
	@section('options')
		<div class="actions">
            
		</div>	
	@endsection
@endsection

{{-- STYLES--}}
@section('styles')
	{{-- Include Styles Here --}}
@endsection

{{-- CONTENT --}}
@section('content')
	@component('vadmin.components.mainloader')@endcomponent
    <div class="container">
		<div class="row">
            
		</div>
	</div>  
	
@endsection

@section('scripts')
	<script src="https://api.trello.com/1/client.js?key=415fe6fe76eceb99eb1422112ca190db"></script>
@endsection

@section('custom_js')

	<script type="text/javascript">
        // var authenticationSuccess = function() { console.log('Successful authentication'); };
        // var authenticationFailure = function() { console.log('Failed authentication'); };

        // Trello.authorize({
        //     type: 'popup',
        //     name: 'Getting Started Application',
        //     scope: {
        //         read: 'true',
        //         write: 'true' },
        //     expiration: 'never',
        //     success: authenticationSuccess,
        //     error: authenticationFailure
        // });

        // var myList = '58f49d9b121d5b9a9dca81cd';
        // var creationSuccess = function(data) {
        // console.log('Card created successfully. Data returned:' + JSON.stringify(data));
        // };
        // var newCard = {
        // name: 'New Test Card', 
        // desc: 'This is the description of our new card.',
        // // Place this card at the top of our list 
        // idList: myList,
        // pos: 'top'
        // };
        
        // Trello.post('/cards/', newCard, creationSuccess);

        // // Trello.put('/cards/[ID]', {name: 'New Test Card'});


	</script>

@endsection

