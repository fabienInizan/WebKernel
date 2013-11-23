<?php

class User
{	
	private $_id;
	private $_alias;
	private $_login;
	private $_password;
	private $_accessLevel;

	public function getId()
	{
		return $this->_id;
	}
	
	public function getAlias()
	{
		return $this->_alias;
	}

	public function getLogin()
	{
		return $this->_login;
	}

	public function getPassword()
	{
		return $this->_password;
	}
	
	public function getAccessLevel()
	{
		return $this->_accessLevel;
	}
	
	public function setId($id)
	{
		$this->_id = $id;
	}
	
	public function setAlias($alias)
	{
		$this->_alias = $alias;
	}

	public function setLogin($login)
	{
		$this->_login = $login;
	}

	public function setPassword($password)
	{
		$this->_password = $password;
	}
	
	public function setAccessLevel($accessLevel)
	{
		$this->_accessLevel = $accessLevel;
	}
}

?>
