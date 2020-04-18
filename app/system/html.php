<?php

class html {

	/**
	 * Convert HTML characters to entities.
	 *
	 * The encoding specified in the application configuration file will be used.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public static function entities($value)
	{
		return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
	}
	
	/**
	 * Generate a link to a JavaScript file.
	 * 
	 * @param string $url
	 * @return string
	 */
	public static function script($url)
	{
		return '<script type="text/javascript" src="'. $url .'"></script>'. PHP_EOL;
	}

	/**
	 * Generate a link to a Style file.
	 *
	 * @param string
	 * @return string
	 */
	public static function style($url)
	{
		return '<link rel="stylesheet" href="'. $url .'">'. PHP_EOL;
	}

	/**
	 * 
	 */
	public static function image($url, $alt = '')
	{
		return '<img src="'. $url .'" alt="'. static::entities($alt) .'">';
	}

	public static function link($url, $title = null)
	{
		if ( is_null($title) ) $title = $url;

		return '<a href="'. $url .'">'. static::entities($title) .'</a>';
	}
}
?>