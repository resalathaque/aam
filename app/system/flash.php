<?php

class Flash {
	
	/**
	 * Add flash message
	 * @param string $name
	 * @param string $message
	 */
	public static function add($message)
	{
		Session::set('_flash', $message);
	}

	/**
	 * get flash message
	 *
	 * @param string $name
	 */
	public static function get($default = null)
	{
		if ( static::has() )
		{
			$message = App::session('_flash');
			App::session('_flash', null);
			return $message;
		}

		return $default;
	}

	public static function has()
	{
		return (bool) App::session('_flash');
	}
}
?>