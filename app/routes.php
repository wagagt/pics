<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//Route::get('admin-app.clasificados.dev/product', 'admin/ProductsController@status');

// ------------------- Admin section ----------------------------------------
Route::group(array('domain' => Config::get('app.admindomain')), function() {
	Route::controller('login', 'LoginController');
	Route::post('/product', 'ProductsController@status');
	Route::get('/product/{id}', 'ProductsController@getInfo');

	
	Route::group(array('before' => 'auth'), function() {

	   	Route::get('/{view?}',  'DashboardController@index') 		// Products Views
        ->where('view', "^(news|denied|approved)$"); 
        
		Route::resource('admins', 'AdminsController');
		Route::get('/logout', 'LoginController@getLogout');
		
	});

});
// ------------------- End Admin Section ------------------------------------




// ------------------- API section ----------------------------------------
Route::group(array('prefix' => 'api/v1', 'domain' => Config::get('app.domain')), function() {

	//header('Access-Control-Allow-Origin: *');
	//header('Access-Control-Allow-Credentials: false');
	Route::group(array('before' => 'token'),function(){	
		Route::resource('images', 'ImagesController', array(
			'except' => array('create', 'edit'),
		));
	});
	
	// items
	Route::resource('items', 'ItemsController', array(
		'except' => array('create', 'edit'),
	));
	// busquedas
	Route::group(array('before' => 'coordinates'),function(){	
		Route::get('/category/{category_id}', 'SearchController@category')
			->where('category_id', '^([1-9]|10)$');
		Route::get('/term/{term}', 'SearchController@term');
	});
		Route::get('/search/{key}/{page}', 'SearchController@index');
	// data de usuarios
	Route::resource('user', 'UserController', array(
		'only' => array('show', 'store')
	));
	
	Route::get('/',function(){ return Response::json(array('status_code' => 400, 'errors' => array('MissingRequiredQueryParameter'))); });
});	
// ------------------- End API Section ------------------------------------





// ------------------- Web section ----------------------------------------
Route::get('/', function() {
	return View::make('hello');
});
// ------------------- End Web Section ------------------------------------




if(App::environment()=='local' && !App::runningInConsole()){
	DB::listen(function($query)
	{
		// die($query);
		// Get an instance of Monolog
		$monolog = Log::getMonolog();
		// Choose FirePHP as the log handler
		$monolog->pushHandler(new \Monolog\Handler\FirePHPHandler());
		// Start logging
		// $monolog->addInfo('SQL', array('query' => $query));
	
	
	});
}