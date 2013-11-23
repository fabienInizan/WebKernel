<?php

class AccessLevel
{	
	private $_id;
	private $_level;
	private $_name;

	public function getId()
	{
		return $this->_id;
	}
	
	public function getLevel()
	{
		return $this->_level;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function setId($id)
	{
		$this->_id = $id;
	}
	
	public function setLevel($level)
	{
		$this->_level = $level;
	}

	public function setName($name)
	{
		$this->_name = $name;
	}
}

?>
