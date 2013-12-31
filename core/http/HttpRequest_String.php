<?php

require_once('lib/collection/Collection_Default.php');
require_once('core/http/HttpRequest.php');

class HttpRequest_String extends Collection_Default implements HttpRequest
{
	public function __construct($string)
	{
		$associations = explode(';', $string);
		$values = array();
		foreach($associations as $association)
		{
			list($key, $value) = explode('=', $association);
			$values[$key] = $value;
		}

		$this->_recursivlyStripSlashes($values);

		parent::__construct($values);
	}

	private function _recursivlyStripSlashes(array $values)
	{
		$strippedValues = array();

		foreach($values as $key=>$value)
		{
			if(is_array($value))
			{
				$strippedValues[$key] = $this->_recursivlyStripSlashes($value);
			}
			else
			{
				$strippedValues[$key] = stripslashes($value);
			}
		}

		return $strippedValues;
	}
}

?>
