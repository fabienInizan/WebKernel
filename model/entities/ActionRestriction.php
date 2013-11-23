<?php

class ActionRestriction
{	
	private $_id;
	private $_module;
	private $_action;
	private $_description;
	private $_accessLevel;

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

	public function getDescription()
	{
		return $this->_description;
	}
	
	public function getAccessLevel()
	{
		return $this->_accessLevel;
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

	public function setDescription($description)
	{
		$this->_description = $description;
	}
	
	public function setAccessLevel($accessLevel)
	{
		$this->_accessLevel = $accessLevel;
	}
}

?>
