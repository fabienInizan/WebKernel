<?php

require_once('model/containers/Container_Pdo.php');
require_once('model/entities/ActionRestriction.php');
require_once('model/containers/ActionRestrictionContainer.php');
require_once('model/entities/Page.php');
require_once('model/containers/PageContainer.php');

class __pageDbHelper extends Container_Pdo
{
	private static $_instance;
	
	private $_actionRestrictionDescriptors = array(
		array(
			'action'=>'add',
			'description'=>'Create a new page',
			'accessLevel'=>255
		),
		array(
			'action'=>'delete',
			'description'=>'Delete a page',
			'accessLevel'=>255
		),
		array(
			'action'=>'display',
			'description'=>'Display a page',
			'accessLevel'=>0
		),
		array(
			'action'=>'displayAddForm',
			'description'=>'Display the page creation form',
			'accessLevel'=>255
		),
		array(
			'action'=>'displayEditForm',
			'description'=>'Display the page edition form',
			'accessLevel'=>255
		),
		array(
			'action'=>'displayDeleteForm',
			'description'=>'Display the page delete form',
			'accessLevel'=>255
		),
		array(
			'action'=>'edit',
			'description'=>'Apply modifications to a page',
			'accessLevel'=>255
		),
		array(
			'action'=>'index',
			'description'=>'Display a list of the pages',
			'accessLevel'=>255
		)
	);

	public static function getInstance()
	{
		if(empty(self::$_instance))
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}
	
	public function dbInstall()
	{
		$query = 'CREATE TABLE IF NOT EXISTS `page` (
			`id` varchar(255) NOT NULL,
			`title` varchar(511) DEFAULT NULL,
			`content` text,
			PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=latin1';
		
		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		
		$actionRestrictionContainer = ActionRestrictionContainer::getInstance();
		$actionRestriction = new ActionRestriction();
		$actionRestriction->setModule('page');
		
		foreach($this->_actionRestrictionDescriptors as $actionRestrictionDescriptor)
		{
			$actionRestriction->setAction($actionRestrictionDescriptor['action']);
			$actionRestriction->setDescription($actionRestrictionDescriptor['description']);
			$actionRestriction->setAccessLevel($actionRestrictionDescriptor['accessLevel']);
			$actionRestrictionContainer->save($actionRestriction);
		}
	}
	
	public function dbPurge()
	{
		$query = 'DELETE FROM page';
		
		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
	}
	
	public function dbUninstall()
	{		
		$query = 'DROP TABLE IF EXISTS page';
		
		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		
		$actionRestrictionContainer = ActionRestrictionContainer::getInstance();
		$actionRestrictionContainer->deleteByModule('page');
	}
}

?>
