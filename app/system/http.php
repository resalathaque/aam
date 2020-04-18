<?php
/**
* curl request
*/
class Http {
	
	const user_agent = 'LARAVEL 4.2';
	
	protected $timeout = 10;

	protected $options = array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HEADER => false,
		CURLOPT_SSL_VERIFYPEER => false,
	);
	
	function __construct($uri)
	{
		if ( !function_exists('curl_init'))
			throw new HttpException('Your PHP installation doesn\'t have cURL enabled. Rebuild PHP with --with-curl');

		$this->connection = curl_init($uri);
	}


	function request($method, $data = array())
	{
		switch ($method) {
			case 'GET':
				# code...
				break;

			case 'POST':
				$this->setOptions(array(
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => $data,
				));
				break;

			case 'PUT':
				# code...
				break;

			case 'DELETE':
				$this->setOptions(array(
					CURLOPT_CUSTOMREQUEST => 'DELETE'
				));
				break;

			default:
				# code...
				break;
		}

		curl_setopt_array($this->connection, $this->options);
		$body = curl_exec($this->connection);
		
		if ( !$body ) throw new HttpException(curl_error($this->connection), curl_errno($this->connection));

		curl_close($this->connection);
		return $body;
	}

	function setOptions($options)
	{
		array_merge($this->options, $options);
	}

	public static function __callstatic($method, $params)
	{
		$http = new static($params[0]);
		return $http->request(strtoupper($method), @$params[1]);
	}
}

class HttpException extends Exception{}

?>