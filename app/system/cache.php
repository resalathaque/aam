<?php

class Cache {

	private $key;

	function __construct($key)
	{
		$this->key = $key;
	}

	public static function make($key)
	{
		return new static($key);
	}

	public function get()
	{
		$path = $this->path($this->key);

		if (@filemtime($path) > (time() - 86400))
		{
			return false;
		}

		if ($data = @file_get_contents($path))
		{
			return json_decode($data);
		}

		return false;
	}

	public function put($data)
	{
		$path = $this->path($this->key);
		@file_put_contents($path, json_encode($data));
	}

	private function path($key)
	{
		return app_path . 'storage/cache/'. md5($key);
	}
}

?>