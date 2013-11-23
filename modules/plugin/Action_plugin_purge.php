<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/PluginContainer.php');

class Action_plugin_purge implements Action
{
	private function _purgeDatabase($plugin)
	{
		$dbHelperClass = '__'.$plugin->getId().'DbHelper';
		$dbHelperInclude = $plugin->getPath().'/'.$dbHelperClass.'.php';
		
		if(!is_file($dbHelperInclude))
		{
			throw new Exception('Cannot purge this plugin, missing '.$dbHelperInclude);
		}
		
		require_once($dbHelperInclude);
		$dbHelper = $dbHelperClass::getInstance();
		
		try
		{
			$dbHelper->dbPurge();
		}
		catch(Exception $e)
		{
			throw new Exception('Purge error : unable to purge database. Error : '.$e->getMessage());
		}
	}
	
	public function run(HttpRequest $httpRequest)
	{
		$id = $httpRequest->pluginId;

		$actionResponse = new ActionResponse_Default();
		
		if(isset($id))
		{
			$pluginContainer = PluginContainer::getInstance();
			$plugin = $pluginContainer->getById($id);
			
			if(isset($plugin))
			{
				$this->_purgeDatabase($plugin);			
			}
			else
			{		
				throw new Exception('Le plugin demandé n\'est pas installé');
			}
		}
		else
		{
			throw new Exception('Le plugin demandé n\'est pas installé');
		}

		return $actionResponse;
	}
}

?>
