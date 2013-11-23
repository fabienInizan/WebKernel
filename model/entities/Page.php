<?php

class Page
{
	private $_id;
	private $_title;
	private $_content;

	public function getId()
	{
		return $this->_id;
	}

	public function getTitle()
	{
		return $this->_title;
	}

	public function getContent()
	{
		return $this->_content;
	}

	public function setId($id)
	{
		$this->_id = $id;
	}

	public function setTitle($title)
	{
		$this->_title = $title;
	}

	public function setContent($content)
	{
		$this->_content = $content;
	}
}

?>