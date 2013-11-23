<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/PluginContainer.php');

class Action_plugin_displayDeleteForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$id = $httpRequest->pluginId;
		
		$actionResponse = new ActionResponse_Default();
		
		if(!empty($id))
		{
			$pluginContainer = PluginContainer::getInstance();
			$plugin = $pluginContainer->getById($id);
			
			if(!empty($plugin))
			{
				$actionResponse->setElement('plugin', $plugin);				
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
