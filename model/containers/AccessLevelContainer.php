<?php

require_once('model/containers/Container_Pdo.php');

class AccessLevelContainer extends Container_Pdo
{
	private static $_instance;

	public function getAll()
	{
		$query = 'SELECT * FROM accessLevel';

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$accessLevels = array();
		
		foreach($rows as $row)
		{
			$accessLevels[] = $this->createEntity('AccessLevel', $row);
		}
		
		return $accessLevels;
	}

	public function getAllButAdmin()
	{
		$query = 'SELECT * FROM accessLevel WHERE accessLevel.level < 255';

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$accessLevels = array();
		
		foreach($rows as $row)
		{
			$accessLevels[] = $this->createEntity('AccessLevel', $row);
		}
		
		return $accessLevels;
	}

	public function getById($id)
	{
		$query = 'SELECT * FROM accessLevel WHERE accessLevel.id = :id';

		$params = array('id'=>$id);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($row))
		{
			throw new Exception('Cannot find required access level');
		}

		return $this->createEntity('AccessLevel', $row);
	}
	
	public function getByLevel($level)
	{
		$query = 'SELECT * FROM accessLevel WHERE accessLevel.level = :level';

		$params = array('level'=>$level);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($row))
		{
			throw new Exception('Cannot find required access level');
		}

		return $this->createEntity('AccessLevel', $row);
	}

	public static function getInstance()
	{
		if(empty(self::$_instance))
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function save(AccessLevel $accessLevel)
	{
		$id = $accessLevel->getId();
		$double = null;
		
		try
		{
			$double = $this->getById($id);
		}
		catch(Exception $e)
		{
		}

		if(!empty($double))
		{
			$query = 'UPDATE accessLevel SET accessLevel.level = :level, accessLevel.name = :name WHERE accessLevel.id = :id';

			$params = array('id'=>$accessLevel->getId(),
							'level'=>$accessLevel->getLevel(),
							'name'=>$accessLevel->getName());
		}
		else
		{
			$query = 'INSERT INTO accessLevel(id, level, name) VALUES(:id, :level, :name)';

			$params = array('id'=>$accessLevel->getId(),
							'level'=>$accessLevel->getLevel(),
							'name'=>$accessLevel->getName());
		}

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}

	public function delete(AccessLevel $accessLevel)
	{
		$query = 'DELETE FROM accessLevel WHERE accessLevel.id = :id';

		$params = array('id'=>$accessLevel->getId());

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}
}

?>
