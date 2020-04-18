<?php

define('app_path', __DIR__ . DIRECTORY_SEPARATOR);

define('storage_path', app_path .'storage');



/*
|--------------------------------------------------------------------------
| Register Auto Loader
|--------------------------------------------------------------------------
*/

require app_path .'system/func.php';
require app_path .'system/autoloader.php';

Autoloader::addDirectories(array(
	app_path .'system',
	app_path .'models',
	app_path .'controllers',
));

Autoloader::register();


/*
|--------------------------------------------------------------------------
| Set Timezone
|--------------------------------------------------------------------------
*/

date_default_timezone_set(Config::app('timezone', 'UTC'));


/*
|--------------------------------------------------------------------------
| Error handlers
|--------------------------------------------------------------------------
*/

set_exception_handler('Error::exception');

set_error_handler('Error::native');

register_shutdown_function('Error::shutdown');


/*
|--------------------------------------------------------------------------
| Start Session
|--------------------------------------------------------------------------
*/

// don't need sessions
// Session::start();


/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

require app_path .'routes.php';


/*
|--------------------------------------------------------------------------
| Notfound Handler
|--------------------------------------------------------------------------
*/

Route::error('App::abort');

?>