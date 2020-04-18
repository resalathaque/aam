<?php
/**
* 
*/
class Log
{
	
	function __construct()
	{
		
	}

	function exception_line($e)
	{
		return $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine();
	}

	protected function format($type, $message)
	{
		return date('Y-m-d H:i:s').' '.$type." - {$message}".PHP_EOL;
	}

	function write($type, $message)
	{
		$message = $this->format($type, $message);
		file_put_contents(storage_path .'/logs/'.date('Y-m-d').'.log', $message, FILE_APPEND );
	}

	public static function __callstatic($method, $params)
	{
		$log = new self;
		$log->write($method, $params[0]);
	}
}
?>