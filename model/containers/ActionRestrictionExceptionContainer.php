<?php

require_once('model/containers/Container_Pdo.php');

class ActionRestrictionExceptionContainer extends Container_Pdo
{
	private static $_instance;

	public static function getInstance()
	{
		if(empty(self::$_instance))
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function getAll()
	{
		$query = 'SELECT * FROM `actionRestrictionException`';

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$actionRestrictionExceptions = array();

		foreach($rows as $row)
		{
			$actionRestrictionExceptions[] = $this->createEntity('ActionRestrictionException', $row);
		}

		return $actionRestrictionExceptions;
	}
	
	public function getByModuleAndAction($module, $action)
	{
		$query = 'SELECT * FROM `actionRestrictionException` WHERE actionRestrictionException.module = :module AND actionRestrictionException.action = :action';

		$params = array('module'=>$module, 'action'=>$action);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$actionRestrictionExceptions = array();
		foreach($rows as $row)
		{
			$actionRestrictionExceptions[] = $this->createEntity('ActionRestrictionException', $row);
		}

		return $actionRestrictionExceptions;
	}

	public function getById($id)
	{
		$query = 'SELECT * FROM `actionRestrictionException` WHERE actionRestrictionException.id = :id';

		$params = array('id'=>$id);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($row))
		{
			throw new Exception('Cannot find required actionRestrictionException');
		}

		return $this->createEntity('ActionRestrictionException', $row);
	}

	public function save(ActionRestrictionException $actionRestrictionException)
	{
		$id = $actionRestrictionException->getId();
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
			$query = 'UPDATE `actionRestrictionException` SET actionRestrictionException.module = :module, actionRestrictionException.action = :action, actionRestrictionException.exceptionString = :exceptionString, actionRestrictionException.accessLevel = :accessLevel, actionRestrictionException.description = :description WHERE actionRestrictionException.id = :id';

			$params = array('id'=>$actionRestrictionException->getId(), 'module'=>$actionRestrictionException->getModule(), 'action'=>$actionRestrictionException->getAction(), 'exceptionString'=>$actionRestrictionException->getExceptionString(), 'accessLevel'=>$actionRestrictionException->getAccessLevel(), 'description'=>$actionRestrictionException->getDescription());
		}
		else
		{
			$query = 'INSERT INTO `actionRestrictionException`(id, module, action, exceptionString, accessLevel, description) VALUES(:id, :module, :action, :exceptionString, :accessLevel, :description)';

			$params = array('id'=>$actionRestrictionException->getId(), 'module'=>$actionRestrictionException->getModule(), 'action'=>$actionRestrictionException->getAction(), 'exceptionString'=>$actionRestrictionException->getExceptionString(), 'accessLevel'=>$actionRestrictionException->getAccessLevel(), 'description'=>$actionRestrictionException->getDescription());
		}

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);

		if(empty($id))
		{
			$actionRestrictionException->setId($this->getPdo()->lastInsertId());
		}
	}

	public function delete(ActionRestrictionException $actionRestrictionException)
	{
		$query = 'DELETE FROM `actionRestrictionException` WHERE actionRestrictionException.id = :id';

		$params = array('id'=>$actionRestrictionException->getId());

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}
}

?>
