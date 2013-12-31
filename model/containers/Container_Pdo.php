<?php

require_once('lib/settings/Settings_Config.php');

class Container_Pdo
{
	private $_pdo;

	public function __construct()
	{
		$conf = Settings_Config::getInstance();
		$dsn = $conf->dbType.':dbname='.$conf->dbName.';host='.$conf->dbHost;
		$this->_pdo = new PDO($dsn, $conf->dbUser, $conf->dbPassword);
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
