










{{----------- NEW MODAL -----------}}
@component('vadmin.layouts.components.modal')

	@slot('id','ExampleModal')
	@slot('title', 'Nuevo Usuario')

	@slot('content')
		Contenito
	@endslot
	@slot('actionBtnId','NewBtn')
	@slot('acceptBtn', 'Crear Usuario')

@endcomponent