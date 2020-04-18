<?php

class Config {
	
	/**
	 * @var array
	 */
	protected static $sources = array();

	/**
	 * @const error message
	 */
	const error = 'Configuration file {%s} dose not exists!';

	/**
	 * Fetch configuration with array cache
	 * 
	 * @param string cache name
	 * @return array
	 */
	protected static function fetch($name)
	{
		if (isset(static::$sources[$name]))
			return static::$sources[$name];

		if (file_exists($path = app_path .'/config/'. $name .'.php'))
		{
			static::$sources[$name] = (array) include($path);
			return static::$sources[$name];
		}

		throw new ConfigException(sprintf(static::error, $name), 1);
		
	}

	public static function get($name, $key = null, $default = '')
	{
		if (is_null($key))
			return static::fetch($name);
		
		else
			return App::array_get(static::fetch($name), $key, $default);
	}

	public static function __callstatic($method, $params)
	{
		return static::get($method, @$params[0], @$params[1]);
	}
}


class ConfigException extends Exception{}
?>