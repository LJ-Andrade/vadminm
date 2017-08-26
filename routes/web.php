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

	// ---------------- Clientes --------------------------------------- //
	Route::resource('clientes', 'ClientesController');
		
	Route::get('ajax_list_clients/{page?}', 'ClientesController@ajax_list');
	Route::get('get_client/{id}', 'ClientesController@get_client');
	Route::get('get_client_data/{id}', 'ClientesController@get_client_data');
	// Searcher
	Route::get('ajax_list_search_clientes/{search?}', 'ClientesController@ajax_list_search');

	// ---------------- Cuenta Corriente Clientes ---------------------- //
	Route::get('clientes/cuenta/{id}', 'ClientesController@account');
	Route::get('buscarcuenta', 'ClientesController@buscarcuenta');

	// ---------------- Provincias ------------------------------------- //
	Route::resource('provincias', 'ProvinciasController');
	Route::get('/get_locs/{id}', 'LocalidadesController@get_locs');

	// ---------------- Secciones Varias-------------------------------- //
	Route::resource('localidades', 'LocalidadesController');
	Route::resource('zonas', 'ZonasController');
	Route::resource('fletes', 'FletesController');
	Route::resource('ivas', 'IvasController');
	Route::resource('familias', 'FamiliasController');
	Route::resource('subfamilias', 'SubfamiliasController');

	// ---------------- Condiciones de Venta --------------------------- //
	Route::resource('condicventas', 'Condicventas\CondicventasController');
	Route::post('ajax_delete_condicventa/{id}', 'Condicventas\CondicventasController@destroy');
	Route::post('ajax_batch_delete_condicventas/{id}', 'Condicventas\CondicventasController@ajax_batch_delete');

	// ---------------- Listas de Precios ------------------------------- //
	Route::resource('listas', 'Listas\ListasController');
	Route::post('ajax_delete_lista/{id}', 'Listas\ListasController@destroy');
	Route::post('ajax_batch_delete_listas/{id}', 'Listas\ListasController@ajax_batch_delete');

	// ---------------- Direcciones de Entrega -------------------------- //
	Route::resource('direntregas', 'DirentregasController');
	Route::post('ajax_delete_direntrega/{id}', 'DirentregasController@destroy');
	Route::post('ajax_batch_delete_direntregas/{id}', 'DirentregasController@ajax_batch_delete');

	// ---------------- Listado de Vendedores --------------------------- //
	Route::get('vendedores', function () {
		return view('vadmin.vendedores');
	});
	Route::get('vendedores', 'VadminController@vendedores');

	// ---------------- Listado de Proveedores -------------------------- //
	Route::resource('proveedores', 'ProveedoresController');
	Route::post('ajax_delete_proveedor/{id}', 'ProveedoresController@destroy');
	Route::post('ajax_batch_delete_proveedores/{id}', 'ProveedoresController@ajax_batch_delete');

	// ---------------- Listado de Monedas ------------------------------ //
	Route::resource('monedas', 'Monedas\MonedasController');
	Route::post('ajax_delete_moneda/{id}', 'Monedas\MonedasController@destroy');
	Route::post('ajax_batch_delete_monedas/{id}', 'Monedas\MonedasController@ajax_batch_delete');

	Route::post('ajax_update_dolar/{id}', 'Monedas\MonedasController@updateDolarValue');

	// ---------------- Tipo de Cliente --------------------------------- //
	Route::resource('tipocts', 'TipoctsController');
	
	// ---------------- Productos --------------------------------------- //
	Route::resource('productos', 'ProductosController');
	Route::get('get_product/{id}', 'ProductosController@get_product');
	Route::get('show_products/{id}', 'ProductosController@ajax_show_products');
	Route::get('ajax_autocomplete/{query?}', 'ProductosController@ajax_autocomplete');
	Route::get('/productos_subfamilias/{id}', 'ProductosController@ajax_subfamilias');
	Route::post('get_product_data/{id}', 'ProductosController@get_product_data');
	
	// Updates
	Route::post('get_product_and_price/{id}', 'ProductosController@get_product_and_price');
	Route::post('get_product_full_price/{id}', 'ProductosController@get_product_full_price');
	
	Route::post('updateCurrencyAndPrice', 'ProductosController@updateCurrencyAndPrice');
	Route::post('update_prod_costprice/{id}', 'ProductosController@updateCostPrice');
	Route::post('update_prod_status/{id}', 'ProductosController@updateStatus');

	// Prices Lists
	Route::get('listas', 'ProductosController@listas')->name('productos.listas');
	Route::get('exportPricesListPdf/{familias}/{tipocte}', 'ProductosController@exportPricesListPdf');
	Route::get('exportPricesListExcel/{familias}/{tipocte}', 'ProductosController@exportPricesListExcel');
	// Stock
	// Route::get('/productos/stock', 'ProductosController@stock');
	Route::get('stock', 'ProductosController@stock')->name('productos.stock');
	Route::get('get_product_stock/{id}', 'ProductosController@get_product_stock');
	Route::post('update_prod_stock/{id}', 'ProductosController@updateStock');

	// ------------------  Pedidos ----------------------------------------- //
	Route::resource('pedidos', 'PedidosController');
	Route::post('update_pedido_status/{id}', 'PedidosController@updateStatus');

	// ------------------- Generador de Orden de Pedidos e Items ----------- //
	Route::post('ajax_store_pedido/{id}', 'PedidosController@ajax_store');
	Route::post('ajax_store_pedidositems/{id}', 'PedidositemsController@ajax_store');
	Route::get('ajax_get_cliente/{id}', 'ClientesController@ajax_get');
	Route::post('ajax_store_pedidoitem', 'PedidositemsController@ajax_store_item');
	
	// ------------------- Pedidos Items ----------------------------------- //
	Route::resource('pedidositems', 'PedidositemsController');
	Route::post('ajax_delete_pedidositem/{id}', 'PedidositemsController@destroy');
	// Route::post('ajax_batch_delete_pedidositems/{id}', 'PedidositemsController@ajax_batch_delete');
	Route::post('ajax_delete_pedidositem/{id}', 'PedidositemsController@destroy');

	// ------------------- Reparaciones ------------------------------------ //
	Route::resource('reparaciones', 'ReparacionesController');
	// Route::post('ajax_store_reparacionesitems/{id}', 'ReparacionesController@ajax_store');
	Route::get('ajax_get_cliente/{id}', 'ClientesController@ajax_get');
	Route::post('ajax_store_reparacionesitem', 'ReparacionesitemsController@ajax_store_item');
	Route::post('update_repair_status/{id}', 'ReparacionesController@updateStatus');
	
	Route::post('ajax_delete_reparacion/{id}', 'ReparacionesController@destroy');
	Route::post('ajax_batch_delete_reparaciones/{id}', 'ReparacionesController@ajax_batch_delete');

	// ------------------- Reparaciones Items------------------------- //
	Route::resource('reparaciones-items', 'ReparacionesItemsController');
	Route::post('ajax_delete_reparacionesitem/{id}', 'ReparacionesItemsController@destroy');

	Route::post('ajax_store_reparacion/{id}', 'DesarrolloController@ajax_store');

	// ------------------- Tipos de Comprobantes --------------------- //
	Route::resource('tiposcomprobantes', 'TiposComprobantesController');

	
	// ------------------- Comprobantes ------------------------------ //
	Route::resource('comprobantes', 'ComprobantesController');
	Route::get('get_client_doc_data/{id}', 'ClientesController@get_client_doc_data');
	Route::get('store_comp', 'ComprobantesController@store_comp');
	Route::get('get_pending_orders/{id?}', 'ComprobantesController@get_pending_orders');
	Route::post('generate_comp', 'ComprobantesController@generate_comp');

	// ------------------- Facturación ------------------------------- //
	// Route::resource('facturas', 'FacturasController');
	// Route::post('get_fc_data', 'FacturasController@get_fc_data');
	// Route::get('store_fc', 'FacturasController@store_fc');
	
	// ------------------- Movimientos -------------------------- //
	Route::resource('movimientos', 'MovimientosController');
	Route::resource('pagos', 'PagosController');


	
	// ----------------------- Exports --------------------------------- //
	// Client Account
	Route::get('exportAccountExcel/{id}/{type}/{filename}', 'ClientesController@exportExcel');
	Route::get('exportAccountPdf/{id}', 'ClientesController@exportPdf');

	Route::get('exportExcel/{model}/{filename}', 'FileExportController@exportExcel');

	Route::get('exportPedidoPdf/{id}', 'PedidosController@exportPdf');
	
	// ----------------------- DESTROY RECORDS ----------------------- //
	Route::post('delete_provincias/{id}', 'ProvinciasController@destroy');
	Route::post('delete_localidades/{id}', 'LocalidadesController@destroy');
	Route::post('delete_ivas/{id}', 'IvasController@destroy');
	Route::post('delete_tipocts/{id}', 'TipoctsController@destroy');
	Route::post('delete_zonas/{id}', 'ZonasController@destroy');
	Route::post('delete_clients/{id}', 'ClientesController@destroy');
	Route::post('delete_fletes/{id}', 'FletesController@destroy');
	Route::post('delete_pedidos/{id}', 'PedidosController@destroy');
	Route::post('delete_tiposcomprobantes/{id}', 'TiposComprobantesController@destroy');
	Route::post('delete_productos/{id}', 'ProductosController@destroy');
	Route::post('delete_familias/{id}', 'FamiliasController@destroy');
	Route::post('delete_subfamilias/{id}', 'SubfamiliasController@destroy');


	// Developer Map
	Route::resource('desarrollo', 'DesarrolloController');
	
	
});

// Autocomplete
Route::get('/autocomplete', array('as' => 'autocomplete', 'uses'=>'ProductosController@product_autocomplete')); 
Route::get('/client_autocomplete', array('as' => 'client_autocomplete', 'uses'=>'ClientesController@client_autocomplete')); 



