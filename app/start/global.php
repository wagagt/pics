<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/
Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::missing(function($exception)
{
	$error_404 = array('status_code' => 404, 'errors' => array('ResourceNotFound')); 
	return Response::json($error_404);
});

App::error(function(Exception $exception, $code)
{
	
	$api = Config::get('API',false);

	if($api) {
		$message = $exception->getMessage();
		// switch statements provided in case you need to add
		// additional logic for specific error code.
		switch ($code) {
			case 404:
				$message = (!$message ? $message = 'the requested resource was not found' : $message);
				return Response::json(array(
					'code'      =>  404,
					'message'   =>  $message
				), 404);
				break;
			case 500:
				return Response::json(array(
					'code'      =>  404,
					'message'   =>  array($message,$exception->getTraceAsString())
				), 500);
				break;
			default:
				return Response::json(array(
					'code'      =>  $code,
					'message'   =>  $message
				), $code);
		}
	} else {
		if (Request::ajax())
		{
			return Response::json($exception);
		}
	}

	if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException)
        Log::error('NotFoundHttpException Route: ' . Request::url() );

    Log::error($exception);
	

});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';

/* Generate form text and manage msg error from validator */
Form::macro('textWithErrors', function($name, $value, $attributes, $errors){
    if ($errors->has($name)) {
        if (array_key_exists('class', $attributes)) {
            $attributes['class'] .= ' error';
        } else {
            $attributes['class'] = 'error';
        }
    }
    $output = Form::text($name, $value, $attributes);
    if ($errors->has($name)) {
        $output .= $errors->first($name, 
        '<div><i class="fa fa-exclamation-triangle" style="color:red"></i><small>:message</small></div>
        ');
    }
    return $output;
});

/* Generate form text and manage msg error from validator */
Form::macro('passwordWithErrors', function($name, $value, $attributes, $errors){
    if ($errors->has($name)) {
        if (array_key_exists('class', $attributes)) {
            $attributes['class'] .= ' error';
        } else {
            $attributes['class'] = 'error';
        }
    }
    $output = Form::password($name, $value, $attributes);
    if ($errors->has($name)) {
        $output .= $errors->first($name, 
        '<div><i class="fa fa-exclamation-triangle" style="color:red"></i><small>:message</small></div>
        ');
    }
    return $output;
});

