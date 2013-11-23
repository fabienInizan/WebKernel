<?php

require_once('core/http/HttpResponse.php');

class HttpResponse_Default implements HttpResponse
{
	private $_headers;
	private $_content;

	public function __construct()
	{
		$this->_headers = array();
	}

	public function send()
	{
		foreach ($this->_headers as $header)
		{
			header($header);
		}

		echo $this->_content;
	}

	public function addHeader($header)
	{
		$this->_headers[] = $header;
	}

	public function getContent()
	{
		return $this->_content;
	}

	public function setContent($content)
	{
		$this->_content = $content;
	}
}

?>