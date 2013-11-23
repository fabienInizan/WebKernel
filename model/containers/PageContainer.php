<?php

require_once('model/containers/Container_Pdo.php');

class PageContainer extends Container_Pdo
{
	private static $_instance;

	public function getAll()
	{
		$query = 'SELECT * FROM page';

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$pages = array();
		
		foreach($rows as $row)
		{
			$pages[] = $this->createEntity('Page', $row);
		}
		
		return $pages;
	}

	public function getById($id)
	{
		$query = 'SELECT * FROM page WHERE page.id = :id';

		$params = array('id'=>$id);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($row))
		{
			throw new Exception('Cannot find required page');
		}

		return $this->createEntity('Page', $row);
	}

	public static function getInstance()
	{
		if(empty(self::$_instance))
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function save(Page $page)
	{
		$id = $page->getId();
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
			$query = 'UPDATE page SET page.title = :title, page.content = :content WHERE page.id = :id';

			$params = array('id'=>$page->getId(),
							'title'=>$page->getTitle(),
							'content'=>$page->getContent());
		}
		else
		{
			$query = 'INSERT INTO page(id, title, content) VALUES(:id, :title, :content)';

			$params = array('id'=>$page->getId(),
							'title'=>$page->getTitle(),
							'content'=>$page->getContent());
		}

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}

	public function delete(Page $page)
	{
		$query = 'DELETE FROM page WHERE page.id = :id';

		$params = array('id'=>$page->getId());

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}
}

?>
