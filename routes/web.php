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
	Route::resource('clientes', 'ClientesController');
		
	Route::get('ajax_list_clients/{page?}', 'ClientesController@ajax_list');
	Route::get('get_client/{id}', 'ClientesController@get_client');
	Route::get('get_client_data/{id}', 'ClientesController@get_client_data');
	// Searcher
	Route::get('ajax_list_search_clientes/{search?}', 'ClientesController@ajax_list_search');

	// ------------------- Cuenta Corriente Clientes --------------------- //
	Route::get('clientes/cuenta/{id}', 'ClientesController@account');
	Route::get('buscarcuenta', 'ClientesController@buscarcuenta');

	// ------ Provincias ------- //
	Route::resource('provincias', 'ProvinciasController');
	Route::get('/get_locs/{id}', 'LocalidadesController@get_locs');

	// ------ Localidades ------- //
	Route::resource('localidades', 'LocalidadesController');


	// ------ Zonas ------- //
	Route::resource('zonas', 'ZonasController');

	// ------ Fletes ------- //
	Route::resource('fletes', 'FletesController');

	// ------ Categorías Impositivas ------- //
	Route::resource('ivas', 'IvasController');

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
	
	// ------ Listado de Familias ------- //
	Route::resource('familias', 'Familias\FamiliasController');
	Route::post('ajax_delete_familia/{id}', 'Familias\FamiliasController@destroy');
	Route::post('ajax_batch_delete_familias/{id}', 'Familias\FamiliasController@ajax_batch_delete');
	
	// ------ Listado de SubFamilias ------- //
	Route::resource('subfamilias', 'Subfamilias\SubfamiliasController');
	Route::post('ajax_delete_subfamilia/{id}', 'Subfamilias\SubfamiliasController@destroy');
	Route::post('ajax_batch_delete_subfamilias/{id}', 'Subfamilias\SubfamiliasController@ajax_batch_delete');

	// ------ Listado de Proveedores ------- //
	Route::resource('proveedores', 'Proveedores\ProveedoresController');
	Route::post('ajax_delete_proveedor/{id}', 'Proveedores\ProveedoresController@destroy');
	Route::post('ajax_batch_delete_proveedores/{id}', 'Proveedores\ProveedoresController@ajax_batch_delete');

	// ------ Listado de Monedas ------- //
	Route::resource('monedas', 'Monedas\MonedasController');
	Route::post('ajax_delete_moneda/{id}', 'Monedas\MonedasController@destroy');
	Route::post('ajax_batch_delete_monedas/{id}', 'Monedas\MonedasController@ajax_batch_delete');

	Route::post('ajax_update_dolar/{id}', 'Monedas\MonedasController@updateDolarValue');

	// ------ Tipo de Cliente ------- //
	Route::resource('tipocts', 'TipoctsController');
	
	// ------ Productos ------- //
	Route::resource('productos', 'ProductosController');
	Route::post('ajax_delete_producto/{id}', 'ProductosController@destroy');
	Route::post('ajax_batch_delete_productos/{id}', 'ProductosController@ajax_batch_delete');
	Route::post('update_prod_status/{id}', 'ProductosController@updateStatus');

	Route::get('get_product/{id}', 'ProductosController@get_product');
	
	Route::get('ajax_autocomplete/{query?}', 'ProductosController@ajax_autocomplete');
	Route::post('get_product_and_price/{id}', 'ProductosController@get_product_and_price');
	Route::get('get_product_stock/{id}', 'ProductosController@get_product_stock');

	
	Route::post('get_product_data/{id}', 'ProductosController@get_product_data');

	// Route::get('search/autocomplete', 'Productos\ProductosController@autocomplete');

	Route::get('/productos_subfamilias/{id}', 'ProductosController@ajax_subfamilias');
	Route::get('show_products/{id}', 'ProductosController@ajax_show_products');

	Route::post('update_prod_stock/{id}', 'ProductosController@updateStock');
	Route::post('update_prod_costprice/{id}', 'ProductosController@updateCostPrice');

	// ------ Pedidos ------- //
	Route::resource('pedidos', 'PedidosController');
	Route::post('ajax_delete_pedido/{id}', 'PedidosController@destroy');
	Route::post('ajax_batch_delete_pedidos/{id}', 'PedidosController@ajax_batch_delete');
	Route::post('update_pedido_status/{id}', 'PedidosController@updateStatus');

	// ------ Generador de Orden de Pedidos e Items ------- //
	Route::post('ajax_store_pedido/{id}', 'PedidosController@ajax_store');
	Route::post('ajax_store_pedidositems/{id}', 'PedidositemsController@ajax_store');
	Route::get('ajax_get_cliente/{id}', 'ClientesController@ajax_get');
	Route::post('ajax_store_pedidoitem', 'PedidositemsController@ajax_store_item');
	
	// ---------------- Pedidos Items--------------------- //
	Route::resource('pedidositems', 'PedidositemsController');
	Route::post('ajax_delete_pedidositem/{id}', 'PedidositemsController@destroy');
	// Route::post('ajax_batch_delete_pedidositems/{id}', 'PedidositemsController@ajax_batch_delete');
	Route::post('ajax_delete_pedidositem/{id}', 'PedidositemsController@destroy');

	// ------------------- Reparaciones --------------------- //
	Route::resource('reparaciones', 'ReparacionesController');
	// Route::post('ajax_store_reparacionesitems/{id}', 'ReparacionesController@ajax_store');
	Route::get('ajax_get_cliente/{id}', 'ClientesController@ajax_get');
	Route::post('ajax_store_reparacionesitem', 'ReparacionesitemsController@ajax_store_item');
	Route::post('update_repair_status/{id}', 'ReparacionesController@updateStatus');
	
	Route::post('ajax_delete_reparacion/{id}', 'ReparacionesController@destroy');
	Route::post('ajax_batch_delete_reparaciones/{id}', 'ReparacionesController@ajax_batch_delete');

	
	// ---------------- Reparaciones Items--------------------- //
	Route::resource('reparaciones-items', 'ReparacionesItemsController');
	Route::post('ajax_delete_reparacionesitem/{id}', 'ReparacionesItemsController@destroy');

	// ------------------- Facturación --------------------- //
	Route::resource('facturas', 'FacturasController');
	Route::get('get_pending_orders/{id?}', 'FacturasController@get_pending_orders');
	Route::post('get_fc_data', 'FacturasController@get_fc_data');
	Route::get('store_fc', 'FacturasController@store_fc');
	
	// // Almost obsolete
	// Route::post('generate_json_fc', 'FacturasController@generate_json_fc');

	Route::post('generate_fc', 'FacturasController@generate_fc');
	Route::resource('pagos', 'PagosController');
	Route::resource('cheques', 'ChequesController');
	Route::resource('retenciones', 'RetencionesController');

	// Developer Map
	Route::resource('desarrollo', 'DesarrolloController');
	Route::post('ajax_store_reparacion/{id}', 'DesarrolloController@ajax_store');

	// DESTROY RECORDS
	Route::post('delete_provincias/{id}', 'ProvinciasController@destroy');
	Route::post('delete_localidades/{id}', 'LocalidadesController@destroy');
	Route::post('delete_ivas/{id}', 'IvasController@destroy');
	Route::post('delete_tipocts/{id}', 'TipoctsController@destroy');
	Route::post('delete_zonas/{id}', 'ZonasController@destroy');
	Route::post('delete_clients/{id}', 'ClientesController@destroy');
	Route::post('delete_fletes/{id}', 'FletesController@destroy');
	
});

// Autocomplete
Route::get('/autocomplete', array('as' => 'autocomplete', 'uses'=>'Productos\ProductosController@product_autocomplete')); 
Route::get('/client_autocomplete', array('as' => 'client_autocomplete', 'uses'=>'ClientesController@client_autocomplete')); 
