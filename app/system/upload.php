<?php

class Upload extends SplFileInfo {
	
	/**
	 * @var errors array 
	 */
	public $errors = array();

	/**
	 * @var init
	 */
	protected $error_code;

	/**
	 * @var string
	 */
	public $filename;

	public $filesize;

	/**
	 * max upload size
	 * @var int
	 */
	public $max_file_size;

	protected $error_messages = array(
		1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
		2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
		3 => 'The uploaded file was only partially uploaded',
		4 => 'No file was uploaded',
		6 => 'Missing a temporary folder',
		7 => 'Failed to write file to disk',
		8 => 'A PHP extension stopped the file upload'
	);

	protected $mimetype;

	function __construct($key)
	{
		if ( !isset($_FILES[$key]) )
			throw new Exception("Cannot find uploaded file identified by key: $key");
		
		$this->key = $key;
		$this->filename = $_FILES[$key]['name'];
		$this->mimetype = $_FILES[$key]['type'];
		$this->filesize = $_FILES[$key]['size'];
		$this->error_code = $_FILES[$key]['error'];
		parent::__construct($_FILES[$key]['tmp_name']);
	}

	function validate()
	{
		if ( !$this->error_code == UPLOAD_ERR_OK )
			$this->errors[] = $this->error_message[$this->error_code];
	
		if ( !is_uploaded_file($this->key))
			$this->errors[] = 'The uploaded file was not sent with a POST request';

		if ( $this->filesize > $this->max_file_size )
			$this->errors[] = 'The uploaded file is too large';

	}

	public function isOk()
	{
		$this->validate();
		if (empty($this->errors))
			return true;

		return false;
	}

	public function setMaxFileSize($size)
	{
		$this->max_file_size = (int) $size;
	}

	public function setName($name)
	{
		$this->filename = $name;
	}

	function md5()
	{
		return md5_file($this->getPathName());
	}

}
?>