<?php
/**
* Autoload classess
*/
class Autoloader {

	const E_Fatal = 'Fatal error: %s';

	/**
	 * The registered directories.
	 *
	 * @var array
	 */
	protected static $directories = array();

	/**
	 * Indicates if a ClassLoader has been registered.
	 *
	 * @var bool
	 */
	protected static $registered = false;

	
	/**
	 * Load the given class file.
	 *
	 * @param  string  $class
	 * @return void
	 */
	public static function load($class)
	{
		$class = strtolower($class) .'.php';

		foreach (static::$directories as $directory)
		{
			if ( file_exists($path = $directory. DIRECTORY_SEPARATOR .$class) )
			{
				require_once $path;
				return true;
			}
		}

		throw new Exception(sprintf(self::E_Fatal, "Unable to load class: {$class}"));
	}

	/**
	 * Register the given class loader on the auto-loader stack.
	 *
	 * @return void
	 */
	public static function register()
	{
		if ( !static::$registered )
			static::$registered = spl_autoload_register(array('Autoloader', 'load'));
	}

	/**
	 * Add directories to the class loader.
	 *
	 * @param  string|array  $directories
	 * @return void
	 */
	public static function addDirectories($directories)
	{
		static::$directories = array_merge(static::$directories, (array) $directories);

		static::$directories = array_unique(static::$directories);
	}
}
?>