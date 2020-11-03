<?php

class View {

	/**
	 * @const extension
	 */
	const extension = '.php';
	
	/**
	 * view path
	 *
	 * @var string
	 */
	protected $view;

	/**
	 * @var array
	 */
	protected $data = array();


	/**
	 * @param string path
	 * @param array data
	 */
	function __construct($view, $data = array())
	{
		$this->view = $this->path($view);
		$this->data = $data;
	}

	/**
	 * make view instance
	 *
	 * @param string
	 * @param array
	 * @return view
	 */
	public static function make($view, $data = array())
	{
		return new static($view, $data);
	}

	/**
	 * set view paraments
	 *
	 * @param array
	 * @return view
	 */
	public function with($key, $value = null)
	{
		if (is_array($key))
			$this->data = array_merge($this->data, $key);

		else
			$this->data[$key] = $value;

		return $this;
	}


	/**
	 * publish view
	 */
	public function publish()
	{
		ob_start() and extract($this->data, EXTR_SKIP);
		
		try
		{
			include $this->view;
		}
		catch (Exception $e)
		{
			ob_get_clean(); throw $e;
		}
	
		return trim(ob_get_clean());
	}

	/**
	 * Set view path
	 *
	 * @param (string) view name
	 * @return string
	 */
	private function path($view)
	{
		$path = app_path .'/views/'. strtolower(str_replace('.', '/', $view)) . static::extension;
		
		if (! file_exists($path))
			throw new ViewException("View file <b>{$view}</b> does not exists!");

		return $path;
	}

	public function __set($key, $value)
	{
		$this->data[$key] = $value;
	}

	public function __get($key)
	{
		return isset($this->data[$key]) ? $this->data[$key] : null;
	}

	public function __isset($key)
	{
		return isset($this->data[$key]);
	}

	public function __unset($key)
	{
		unset($this->data[$key]);
	}
}


class ViewException extends Exception{}
?>