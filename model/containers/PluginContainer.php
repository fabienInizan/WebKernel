<?php

require_once('model/containers/Container_Pdo.php');

class PluginContainer extends Container_Pdo
{
	private static $_instance;

	public function getAll()
	{
		$query = 'SELECT * FROM plugin';

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$plugins = array();
		
		foreach($rows as $row)
		{
			$plugins[] = $this->createEntity('Plugin', $row);
		}
		
		return $plugins;
	}

	public function getById($id)
	{
		$query = 'SELECT * FROM plugin WHERE plugin.id = :id';

		$params = array('id'=>$id);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($row))
		{
			throw new Exception('Cannot find required plugin');
		}

		return $this->createEntity('Plugin', $row);
	}

	public static function getInstance()
	{
		if(empty(self::$_instance))
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function save(Plugin $plugin)
	{
		$id = $plugin->getId();
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
			$query = 'UPDATE plugin SET plugin.title = :title, plugin.description = :description, plugin.version = :version, plugin.date = :date, plugin.path = :path WHERE plugin.id = :id';

			$params = array('id'=>$plugin->getId(),
							'title'=>$plugin->getTitle(),
							'description'=>$plugin->getDescription(),
							'version'=>$plugin->getVersion(),
							'date'=>$plugin->getDate(),
							'path'=>$plugin->getPath());
		}
		else
		{
			$query = 'INSERT INTO plugin(id, title, description, version, date, path) VALUES(:id, :title, :description, :version, :date, :path)';

			$params = array('id'=>$plugin->getId(),
							'title'=>$plugin->getTitle(),
							'description'=>$plugin->getDescription(),
							'version'=>$plugin->getVersion(),
							'date'=>$plugin->getDate(),
							'path'=>$plugin->getPath());
		}

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}

	public function delete(Plugin $plugin)
	{
		$query = 'DELETE FROM plugin WHERE plugin.id = :id';

		$params = array('id'=>$plugin->getId());

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}
}

?>
