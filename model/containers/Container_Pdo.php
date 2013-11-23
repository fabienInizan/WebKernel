<?php

class Container_Pdo
{
	private $_pdo;

	public function __construct()
	{
		$this->_pdo = new PDO('mysql:dbname=webKernel;host=localhost', 'root', 'paradox66');
	}

	public function createEntity($class, array $attributes)
	{
		if(!class_exists($class))
		{
			require_once('model/entities/'.$class.'.php');
		}

		$entity = new $class();

		foreach($attributes as $key=>$value)
		{
			$setter = 'set'.ucfirst($key);
			$entity->$setter($value);
		}

		return $entity;
	}

	public function getPdo()
	{
		return $this->_pdo;
	}
}

?>
