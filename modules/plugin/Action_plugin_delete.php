<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/PluginContainer.php');
require_once('core/utils/filesystem/FileSystem.php');

class Action_plugin_delete implements Action
{
	private function _deleteDatabase($plugin)
	{
		$dbHelperClass = '__'.$plugin->getId().'DbHelper';
		$dbHelperInclude = $plugin->getPath().'/'.$dbHelperClass.'.php';
		
		if(!is_file($dbHelperInclude))
		{
			throw new Exception('Cannot delete this plugin database, missing '.$dbHelperInclude);
		}
		
		require_once($dbHelperInclude);
		$dbHelper = $dbHelperClass::getInstance();
		
		try
		{
			$dbHelper->dbUninstall();
		}
		catch(Exception $e)
		{
			throw new Exception('Delete error : unable to delete database');
		}
	}
	
	private function _removeAdminMenu($plugin)
	{
		$adminMenuFile = '../plugins/adminMenu/'.$plugin->getId().'_adminMenu.php';
		$exceptions = array();

		try
		{
			FileSystem::remove($adminMenuFile);
		}
		catch(Exception $e)
		{
			/* If the file has been previously deleted, don't stop the whole process at this point */
			$exceptions[] = $e->getMessage();
		}
		
		return $exceptions;
	}
	
	private function _removeFiles($plugin)
	{
		$filesFile = $plugin->getPath().'/__files.php';
		if(!is_file($filesFile))
		{
			throw new Exception('Cannot delete plugin files : missing plugin files list');
		}		
		$files = include_once($filesFile);
		
		$exceptions = array();
		
		foreach($files as $src=>$dst)
		{
			$dstPath = '../'.$dst;	
			
			try
			{
				FileSystem::remove($dstPath);
			}
			catch(Exception $e)
			{	
				/* If any these files has been previously deleted, don't stop the whole process at this point */
				$exceptions = array_merge($exceptions, array($e->getMessage()));
			}
		}
		
		return $exceptions;
	}
	
	private function _removeDirs($plugin)
	{
		$mkdirFile = $plugin->getPath().'/__mkdir.php';
		if(!is_file($mkdirFile))
		{
			throw new Exception('Cannot delete plugin directories : missing plugin directories list');
		}		
		$dirs = include_once($mkdirFile);
		
		$exceptions = array();
		
		foreach($dirs as $dirParent=>$dirName)
		{
			$dirPath = '../'.$dirParent.'/'.$dirName;
			try
			{
				FileSystem::remove($dirPath, true);
			}
			catch(Exception $e)
			{
				/* If any these files has been previously deleted, don't stop the whole process at this point */
				$exceptions = array_merge($exceptions, array($e->getMessage()));
			}
		}
		return $exceptions;
	}
	
	private function _removePluginUploadFiles($plugin)
	{
		$exceptions = array();
		$pluginDir = $plugin->getPath();
		if((fileperms($pluginDir) & 0777) != 0777)
		{
			chmod($pluginDir, 0777);
		}
		
		try
		{
			FileSystem::remove($pluginDir, true);
		}
		catch(Exception $e)
		{
			/* If any these files has been previously deleted, don't stop the whole process at this point */
			$exceptions = array_merge($exceptions, array($e->getMessage()));
		}

		return $exceptions;
	}
	
	private function _unregisterPlugin($plugin)
	{
		$pluginContainer = PluginContainer::getInstance();		
		$pluginContainer->delete($plugin);
	}
	
	public function run(HttpRequest $httpRequest)
	{
		$base = '../plugins';
		
		$actionResponse = new ActionResponse_Default();
		
		$pluginId = $httpRequest->pluginId;
		$deleteDB = $httpRequest->deleteDB;
		
		if(!isset($pluginId))
		{
			throw new Exception('Le plugin demandé n\'est pas installé');
		}
		
		$pluginContainer = PluginContainer::getInstance();		
		$plugin = $pluginContainer->getById($pluginId);
		
		if(!isset($plugin))
		{
			throw new Exception('Le plugin demandé n\'est pas installé');
		}
		
		$exceptions = array();
		
		if(isset($deleteDB) && ($deleteDB == true))
		{
			$this->_deleteDatabase($plugin);
		}

		/* Note : if a file has previously been deleted, don't stop the whole process. Merge them in an array for later use. */
		$exceptions = array_merge($exceptions, $this->_removeAdminMenu($plugin));
		$exceptions = array_merge($exceptions, $this->_removeFiles($plugin));
		$exceptions = array_merge($exceptions, $this->_removeDirs($plugin));
		$exceptions = array_merge($exceptions, $this->_removePluginUploadFiles($plugin));

		$this->_unregisterPlugin($plugin);
		
		$actionResponse->setElement('exceptions', $exceptions);
	
		return $actionResponse;
	}
}

?>
