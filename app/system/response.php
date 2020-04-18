<?php

class Response {

	/**
	 * @var int
	 */
	protected $status = 200;

	/**
	 * @var array
	 */
	protected $headers = array();

	/**
	 * @var string
	 */
	protected $content;

	/**
	 * @var array
	 */
	protected $statuses = array(
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',

		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		307 => 'Temporary Redirect',

		400 => 'Bad Request',
		401 => 'Unauthorized',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',

		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported'
	);
	
	function __construct($content, $status = 200, $headers = array())
	{
		$this->content	=	$content;
		$this->status	=	$status;
		$this->headers	=	array_change_key_case($headers);
	}

	/**
	 * Create new response response instance
	 *
	 * @return Response
	 */
	public static function make($content, $status = 200, $headers = array())
	{
		return new static($content, $status, $headers);
	}


	/**
	 * send response
	 */
	public function send()
	{
		if(ob_get_length() > 0)
			ob_end_clean();

		if ( !headers_sent())
			$this->send_headers();

		exit(trim($this->content));
	}

	/**
	 * send headers
	 */
	public function send_headers()
	{
		// set status
		if (isset($this->statuses[$this->status]))
			header($this->statuses[$this->status], true, $this->status);

		// set other headers
		foreach ($this->headers as $name => $value)
		{
			header("{$name}: {$value}", true);
		}
	}

	/**
	 * Http redirect
	 *
	 * @param string uri
	 * @param int code
	 */
	public static function redirect($uri, $code = 302, $sleep = null)
	{
		if ( is_integer($sleep) ) sleep($sleep);

		header("Location: {$uri}", true, $code);
		exit;
	}

	/**
	 * make Json response
	 * @param object
	 */
	public static function json($obj, $status = 200)
	{
		header($status, true);
		header('Content-type: application/json');
		exit(json_encode($obj, JSON_PRETTY_PRINT));
	}
}
?>