<?php

class App {

	/**
	 * Run application
	 *
	 */
	public static function run()
	{
		$response = Route::dispatch();

		if ($response instanceof Response)
			return;

		elseif ($response instanceof View)
			$content = $response->publish();

		elseif (is_array($response) || is_object($response))
			$content = json_encode($response, JSON_PRETTY_PRINT);

		else $content = $response;

		Response::make($content, 200, array('content-type' => 'text/html'))
			->send();
	}

	/**
	 * Make Class Instance
	 * 
	 * @example App::make('pdo')
	 *
	 * @param string class name
	 * @return instance
	 */
	public static function make($class)
	{
		return new $class();
	}


	public static function abort($code = 404, $message = '')
	{
		$message = "
		<html>
		<head>
			<title>Not found</title>
		</head>
		<body>
			<h1>Page not found!</h1>
		</body>
		</html>";
		
		return Response::make($message, $code)->send();
	}


	/**
	 * Get an item from an array using "dot" notation.
	 *
	 * @param	array	 $array
	 * @param	string	$key
	 * @param	mixed	 $default
	 * @return mixed
	 */
	static function array_get($array, $key, $default = null)
	{
		if (is_null($key)) return $array;

		if (isset($array[$key])) return $array[$key];

		foreach (explode('.', $key) as $segment)
		{
			if ( ! is_array($array) || ! array_key_exists($segment, $array))
			{
				return $default;
			}

			$array = $array[$segment];
		}

		return $array;
	}

	public static function assets($path)
	{
		return Config::get('app', 'base', '') .'/'. $path;
	}

}
?>