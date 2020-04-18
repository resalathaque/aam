<?php

error_reporting(-1);

ini_set('display_errors', 1);


define('APP_START', microtime(true));

require __DIR__ .'/app/start.php';

/*
|--------------------------------------------------------------------------
| Turn on the lights
|--------------------------------------------------------------------------
*/

App::run();

?>