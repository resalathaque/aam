<?php

class Route {
	
	/**
	 * routes
	 *
	 * @var array
	 */
	public static $routes = array();

	/**
	 * methods
	 * @var array
	 */
	public static $methods = array();

	/**
	 * callbacks
	 * @var array
	 */
	public static $callbacks = array();

	public static $filter = array();
	
	/**
	 * patterns
	 * @var array
	 */
	public static $patterns = array(
		':any' => '[^/]+',
		':name' => '[a-z0-9\-_]+',
		':num' => '[0-9]+',
		':all' => '.*'
	);

	/**
	 * @var error callback
	 * string
	 */
	public static $error_callback;

	/**
	 * Defines a route w/ callback and method
	 * Route::get, post, ...
	 * @access public
	 * @return void
	 */
	public static function __callstatic($method, $params)
	{
		// $uri = dirname($_SERVER['PHP_SELF']).'/'.trim($params[0], '/');
		array_push(self::$methods, strtoupper($method));
		array_push(self::$routes, $params[0]);
		array_push(self::$callbacks, $params[1]);
	}

	/**
	 * Defines callback if route is not found
	 */
	public static function error($callback)
	{
		self::$error_callback = $callback;
	}

	/**
	 * Runs the callback for the given request
	 */
	public static function dispatch()
	{
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$method = $_SERVER['REQUEST_METHOD'];
		$searches = array_keys(static::$patterns);
		$replaces = array_values(static::$patterns);

		$found_route = false;

		// check if route is defined without regex
		if (in_array($uri, self::$routes))
		{
			$route_pos = array_keys(self::$routes, $uri);
			foreach ($route_pos as $route)
			{
				if (self::$methods[$route] == $method)
				{
					$found_route = true;
					return call_user_func(self::$callbacks[$route]);
				}
			}
		} else {
			// check if defined with regex
			$pos = 0;
			foreach (self::$routes as $route)
			{
				if (strpos($route, ':') !== false)
					$route = str_replace($searches, $replaces, $route);

				if (preg_match('#^' . $route . '$#', $uri, $matched)) {
					if (self::$methods[$pos] == $method)
					{
						$found_route = true;
						return call_user_func_array(self::$callbacks[$pos], array($matched[1]));
					}
				}
			$pos++;
			}
		}

		// run the error callback if the route was not found
		if ($found_route == false)
		{
			if (!self::$error_callback)
			{
				self::$error_callback = function()
				{
					header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
					echo '404';
				};
			}

			return call_user_func(self::$error_callback);
		}
	}
}
?>