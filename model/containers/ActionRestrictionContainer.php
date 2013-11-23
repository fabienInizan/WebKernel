<?php

require_once('model/containers/Container_Pdo.php');

class ActionRestrictionContainer extends Container_Pdo
{
	private static $_instance;

	public function getAll()
	{
		$query = 'SELECT * FROM actionRestriction';
		
		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$actionRestrictions = array();
		
		foreach($rows as $row)
		{
			$actionRestrictions[] = $this->createEntity('ActionRestriction', $row);
		}
		
		return $actionRestrictions;
	}

	public function getById($id)
	{
		$query = 'SELECT * FROM actionRestriction WHERE actionRestriction.id = :id';

		$params = array('id'=>$id);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($row))
		{
			throw new Exception('Cannot find required action restriction');
		}

		return $this->createEntity('ActionRestriction', $row);
	}
	
	public function getByAccessLevel($accessLevel)
	{
		$query = 'SELECT * FROM actionRestriction WHERE actionRestriction.accessLevel = :accessLevel';

		$params = array('accessLevel'=>$accessLevel);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$actionRestrictions = array();
		
		foreach($rows as $row)
		{
			$actionRestrictions[] = $this->createEntity('ActionRestriction', $row);
		}

		return $actionRestrictions;
	}
	
	public function getByModule($module)
	{
		$query = 'SELECT * FROM actionRestriction WHERE actionRestriction.module = :module';

		$params = array('module'=>$module);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$actionRestrictions = array();
		
		foreach($rows as $row)
		{
			$actionRestrictions[] = $this->createEntity('ActionRestriction', $row);
		}

		return $actionRestrictions;
	}
	
	public function getByModuleAndAction($module, $action)
	{
		$query = 'SELECT * FROM actionRestriction WHERE actionRestriction.module = :module AND actionRestriction.action = :action';

		$params = array('module'=>$module, 'action'=>$action);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($row))
		{
			throw new Exception('Cannot find required action restriction');
		}

		return $this->createEntity('ActionRestriction', $row);
	}

	public static function getInstance()
	{
		if(empty(self::$_instance))
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function save(ActionRestriction $actionRestriction)
	{
		$id = $actionRestriction->getId();
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
			$query = 'UPDATE actionRestriction SET actionRestriction.module = :module, actionRestriction.action = :action, actionRestriction.description = :description, actionRestriction.accessLevel = :accessLevel WHERE actionRestriction.id = :id';

			$params = array('id'=>$actionRestriction->getId(),
							'module'=>$actionRestriction->getModule(),
							'action'=>$actionRestriction->getAction(),
							'description'=>$actionRestriction->getDescription(),
							'accessLevel'=>$actionRestriction->getAccessLevel());
		}
		else
		{
			$query = 'INSERT INTO actionRestriction(id, module, action, description, accessLevel) VALUES(:id, :module, :action, :description, :accessLevel)';

			$params = array('id'=>$actionRestriction->getId(),
							'module'=>$actionRestriction->getModule(),
							'action'=>$actionRestriction->getAction(),
							'description'=>$actionRestriction->getDescription(),
							'accessLevel'=>$actionRestriction->getAccessLevel());
		}

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}

	public function delete(ActionRestriction $actionRestriction)
	{
		$query = 'DELETE FROM actionRestriction WHERE actionRestriction.id = :id';

		$params = array('id'=>$actionRestriction->getId());

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}
	
	public function deleteByModule($module)
	{
		$query = 'DELETE FROM actionRestriction WHERE actionRestriction.module = :module';

		$params = array('module'=>$module);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}
}

?>
