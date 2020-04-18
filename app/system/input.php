<?php

class Input {

	/**
	 * @var array
	 */
	protected static $source = null;

	/**
	 * Get Input
	 */
	public static function get($name = null, $default = '')
	{
		if (is_null(static::$source))
			static::$source = array_merge($_GET, $_POST);

		if (is_string($name))
			return isset(static::$source[$name]) ? static::$source[$name] : $default;

		else return static::$source;
	}

	/**
	 * @param string field name
	 * @return bool
	 */
	public static function has($name)
	{
		return (static::get($name) !== '');
	}

	public static function file($name)
	{
		return isset($_FILES[$name]) ? $_FILES[$name] : null;
	}

	public static function hasFile($name)
	{
		return (bool) is_uploaded_file($name);
	}
}
?>