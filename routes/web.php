<?php

use App\Mail\KryptoniteFound;

Auth::routes();

/////////////////////////////////////////////////
//                   VADMIN                    //
/////////////////////////////////////////////////

// ---------------- Home ---------------------//
Route::get('/vadmin', 'VadminController@index')->middleware('admin');
Route::get('guest', function () {
    return view('vadmin.guest');
});



/////////////////////////////////////////////////
//                   USERS                     //
/////////////////////////////////////////////////

Route::get('profile', 'UsersController@profile');
Route::post('profile', 'UsersController@updateAvatar');	


Route::group(['prefix' => 'vadmin', 'middleware' => ['auth','admin']], function(){

	Route::resource('users', 'UsersController');



	Route::post('ajax_delete_user/{id}', 'UsersController@destroy');
	Route::post('ajax_batch_delete_users/{id}', 'UsersController@ajax_batch_delete');
	Route::post('ajax_update_user/{id}', 'UsersController@update');
	
	Route::get('ajax_list_users/{page?}', 'UsersController@ajax_list');
	// Searcher
	Route::get('ajax_list_search/{search?}', 'UsersController@ajax_list_search');
	Route::get('ajax_list_search/{role?}', 'UsersController@ajax_list_search');

});

// --------------------------------------------//
// --------------------------------------------//

/////////////////////////////////////////////////
//											   //
//              PROJECT ROUTES                 //
//											   //
/////////////////////////////////////////////////


/////////////////////////////////////////////////
//                     WEB                     //
/////////////////////////////////////////////////

// ------------------- Home -------------------//
Route::get('/', [
	'as'   => 'web',
	'uses' => 'WebController@home',
]);


/////////////////////////////////////////////////
//               SECTIONS                      //
/////////////////////////////////////////////////



Route::group(['prefix' => 'vadmin', 'middleware' => ['auth','admin']], function(){

	// ------ Clientes ------- //
	Route::get('ajax_list_clients/{page?}', 'Clientes\ClientesController@ajax_list');
	Route::get('ajax_list_users/{page?}', 'UsersController@ajax_list');
	Route::resource('clientes', 'Clientes\ClientesController');
	Route::post('ajax_delete_cliente/{id}', 'Clientes\ClientesController@destroy');
	Route::post('ajax_batch_delete_clientes/{id}', 'Clientes\ClientesController@ajax_batch_delete');

	// Searcher
	Route::get('ajax_list_search_clientes/{search?}', 'Clientes\ClientesController@ajax_list_search');
	// Route::get('ajax_list_search_clientes/{id?}', 'Clientes\ClientesController@ajax_list_search');

	// ------ Provincias ------- //
	Route::resource('provincias', 'Provincias\ProvinciasController');
	Route::post('ajax_delete_provincia/{id}', 'Provincias\ProvinciasController@destroy');
	Route::post('ajax_batch_delete_provincias/{id}', 'Provincias\ProvinciasController@ajax_batch_delete');

	// ------ Localidades ------- //
	Route::resource('localidades', 'Localidades\LocalidadesController');
	Route::post('ajax_delete_localidad/{id}', 'Localidades\LocalidadesController@destroy');
	Route::post('ajax_batch_delete_localidades/{id}', 'Localidades\LocalidadesController@ajax_batch_delete');

	// ------ Zonas ------- //
	Route::resource('zonas', 'Zonas\ZonasController');
	Route::post('ajax_delete_zona/{id}', 'Zonas\ZonasController@destroy');
	Route::post('ajax_batch_delete_zonas/{id}', 'Zonas\ZonasController@ajax_batch_delete');

	// ------ Fletes ------- //
	Route::resource('fletes', 'Fletes\FletesController');
	Route::post('ajax_delete_flete/{id}', 'Fletes\FletesController@destroy');
	Route::post('ajax_batch_delete_fletes/{id}', 'Fletes\FletesController@ajax_batch_delete');

	// ------ Iva Categorías ------- //
	// Route::resource('iva', 'Iva\IvaController');
	Route::resource('ivas', 'Ivas\IvasController');
	Route::post('ajax_delete_iva/{id}', 'Ivas\IvasController@destroy');
	Route::post('ajax_batch_delete_ivas/{id}', 'Ivas\IvasController@ajax_batch_delete');

	// ------ Condiciones de Venta ------- //
	Route::resource('condicventas', 'Condicventas\CondicventasController');
	Route::post('ajax_delete_condicventa/{id}', 'Condicventas\CondicventasController@destroy');
	Route::post('ajax_batch_delete_condicventas/{id}', 'Condicventas\CondicventasController@ajax_batch_delete');

	// ------ Listas de Precios ------- //
	Route::resource('listas', 'Listas\ListasController');
	Route::post('ajax_delete_lista/{id}', 'Listas\ListasController@destroy');
	Route::post('ajax_batch_delete_listas/{id}', 'Listas\ListasController@ajax_batch_delete');

	// ------ Direcciones de Entrega ------- //
	Route::resource('direntregas', 'Direntregas\DirentregasController');
	Route::post('ajax_delete_direntrega/{id}', 'Direntregas\DirentregasController@destroy');
	Route::post('ajax_batch_delete_direntregas/{id}', 'Direntregas\DirentregasController@ajax_batch_delete');

	Route::get('vendedores', function () {
		return view('vadmin.vendedores');
	});

	// ------ Listado de Vendedores ------- //
	Route::get('vendedores', 'VadminController@vendedores');
});



