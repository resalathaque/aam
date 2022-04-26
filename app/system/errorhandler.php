<?php

class Errorhandler {
	
	/**
	 * Exception handler
	 *
	 * @param Exception
	 */
	public static function exception($e)
	{
		if (Config::app('debug'))
		{
			echo "<html><h2>Unhandled Exception</h2>
				<h3>Message:</h3>
				<pre>".$e->getMessage()."</pre>
				<h3>Location:</h3>
				<pre>".$e->getFile()." on line ".$e->getLine()."</pre>
				<h3>Stack Trace:</h3>
				<pre>".$e->getTraceAsString()."</pre></html>";	
		}
		
		else
		{
			echo '<html><body><h3>Something went wrong! :(</h3></body></html>';
		}
	}

	public static function native($code, $error, $file, $line)
	{
		if (error_reporting() === 0) return;
		throw new Exception(sprintf("%s : ", $error));
	}

	public static function shutdown()
	{
		$error = error_get_last();

		if ( ! is_null($error))
		{
			extract($error, EXTR_SKIP);

			// static::exception(new \ErrorException($message, $type, 0, $file, $line));
		}
	}
}
?>