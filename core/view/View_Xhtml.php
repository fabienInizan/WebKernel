<?php

require_once('core/view/View.php');
require_once('core/http/HttpResponse_Default.php');

class View_Xhtml implements View
{
	private $_fileName;

	public function __construct($fileName)
	{
		$this->_fileName = $fileName;
	}

	public function render(array $elements)
	{
		if(!is_file($this->_fileName))
		{
			throw new Exception('Cannot find template : '.$this->_fileName);
		}

		extract($elements);

		ob_start();
		include($this->_fileName);
		$content = ob_get_clean();

		$httpResponse = new HttpResponse_Default();
		$httpResponse->setContent($content);

		return $httpResponse;
	}
}

?>
