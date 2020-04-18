<?php

class Session {

	const csrf_token = '_token';

	/**
	 * Start session
	 * @return bool
	 */
	public static function start()
	{
		// is session alreay started?
		if (!session_id())
		{
			// start session
			@session_start();
		}

		if (! static::has(self::csrf_token) )
			static::set(self::csrf_token, str_random(30));
	}

	/**
	 * Destroy session
	 */
	public static function destroy()
	{
		if (session_id())
		{
			session_unset();
			session_destroy();
			$_SESSION = array();
		}
	}


	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public static function get($key, $default = null)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
	}

	public static function has($key)
	{
		return isset($_SESSION[$key]);
	}

	function forget($key)
	{
		unset($_SESSION[$key]);
	}

	public static function flash()
	{

	}

	
	public static function token()
	{
		return static::get(Session::csrf_token);
	}
}
?>