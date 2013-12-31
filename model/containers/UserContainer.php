<?php

require_once('model/containers/Container_Pdo.php');

class UserContainer extends Container_Pdo
{
	private static $_instance;

	public function getAll()
	{
		$query = 'SELECT * FROM user';

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$users = array();
		
		foreach($rows as $row)
		{
			$users[] = $this->createEntity('User', $row);
		}
		
		return $users;
	}

	public function getById($id)
	{
		$query = 'SELECT * FROM user WHERE user.id = :id';

		$params = array('id'=>$id);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($row))
		{
			throw new Exception('Cannot find required user');
		}

		return $this->createEntity('User', $row);
	}
	
	public function getByAccessLevel($accessLevel)
	{
		$query = 'SELECT * FROM user WHERE user.accessLevel = :accessLevel';

		$params = array('accessLevel'=>$accessLevel);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$users = array();
		
		foreach($rows as $row)
		{
			$users[] = $this->createEntity('User', $row);
		}
		
		return $users;
	}
	
	public function getByLoginAndPassword($login, $password)
	{
		$query = 'SELECT * FROM user WHERE user.login = :login AND user.password = :password';

		$params = array('login'=>$login, 'password'=>$password);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($row))
		{
			throw new Exception('Cannot find required user');
		}

		return $this->createEntity('User', $row);
	}

	public static function getInstance()
	{
		if(empty(self::$_instance))
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function save(User $user)
	{
		$id = $user->getId();
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
			$query = 'UPDATE user SET user.alias = :alias, user.login = :login, user.password = :password, user.accessLevel = :accessLevel WHERE user.id = :id';

			$params = array('id'=>$user->getId(),
							'alias'=>$user->getAlias(),
							'login'=>$user->getLogin(),
							'password'=>$user->getPassword(),
							'accessLevel'=>$user->getAccessLevel());
		}
		else
		{
			$query = 'INSERT INTO user(id, alias, login, password, accessLevel) VALUES(:id, :alias, :login, :password, :accessLevel)';

			$params = array('id'=>$user->getId(),
							'alias'=>$user->getAlias(),
							'login'=>$user->getLogin(),
							'password'=>$user->getPassword(),
							'accessLevel'=>$user->getAccessLevel());
		}

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}

	public function delete(User $user)
	{
		$query = 'DELETE FROM user WHERE user.id = :id';

		$params = array('id'=>$user->getId());

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}
}

?>
