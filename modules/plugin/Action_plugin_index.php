<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/PluginContainer.php');

class Action_plugin_index implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$pluginContainer = PluginContainer::getInstance();
		$plugins = $pluginContainer->getAll();

		$actionResponse = new ActionResponse_Default();

		$actionResponse->setElement('plugins', $plugins);

		return $actionResponse;
	}
}

?>
