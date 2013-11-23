<?php

class Plugin
{	
	private $_id;
	private $_title;
	private $_description;
	private $_version;
	private $_date;
	private $_path;

	public function getId()
	{
		return $this->_id;
	}

	public function getTitle()
	{
		return $this->_title;
	}

	public function getDescription()
	{
		return $this->_description;
	}
	
	public function getVersion()
	{
		return $this->_version;
	}
	
	public function getDate()
	{
		return $this->_date;
	}
	
	public function getPath()
	{
		return $this->_path;
	}

	public function setId($id)
	{
		$this->_id = $id;
	}

	public function setTitle($title)
	{
		$this->_title = $title;
	}

	public function setDescription($description)
	{
		$this->_description = $description;
	}
	
	public function setVersion($version)
	{
		$this->_version = $version;
	}
	
	public function setDate($date)
	{
		$this->_date = $date;
	}
	
	public function setPath($path)
	{
		$this->_path = $path;
	}
}

?>
