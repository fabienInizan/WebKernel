<?php

class ActionRestrictionException
{
	/* id is mandatory */
	private $_id;
	/* module is mandatory */
	private $_module;
	/* action is mandatory */
	private $_action;
	/* exceptionString is mandatory */
	private $_exceptionString;
	/* accessLevel is mandatory */
	private $_accessLevel;
	private $_description;

	public function getId()
	{
		return $this->_id;
	}

	public function getModule()
	{
		return $this->_module;
	}

	public function getAction()
	{
		return $this->_action;
	}

	public function getExceptionString()
	{
		return $this->_exceptionString;
	}

	public function getAccessLevel()
	{
		return $this->_accessLevel;
	}

	public function getDescription()
	{
		return $this->_description;
	}

	public function setId($id)
	{
		$this->_id = $id;
	}

	public function setModule($module)
	{
		$this->_module = $module;
	}

	public function setAction($action)
	{
		$this->_action = $action;
	}

	public function setExceptionString($exceptionString)
	{
		$this->_exceptionString = $exceptionString;
	}

	public function setAccessLevel($accessLevel)
	{
		$this->_accessLevel = $accessLevel;
	}

	public function setDescription($description)
	{
		$this->_description = $description;
	}
	
	public function exceptionStringToArray()
	{
		$params = explode('&', $this->getExceptionString());
		$exceptionArray = array();
		foreach($params as $param)
		{
			list($key, $value) = explode('=', $param);
			$exceptionArray[$key] = $value;
		}
		
		return $exceptionArray;
	}
	
	public function arrayToExceptionString($params)
	{
		$exceptionString = "";
		foreach($params  as $key=>$value)
		{
			$exceptionString .= $key.'='.$value.'&';
		}
		$exceptionString = substr($exceptionstring, 0, -1);
		
		return $exceptionString;
	}
}

?>
