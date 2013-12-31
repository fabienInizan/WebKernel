<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/PluginContainer.php');

class Action_plugin_display implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$id = $httpRequest->pluginId;

		$pluginContainer = PluginContainer::getInstance();
		$plugin = $pluginContainer->getById($id);

		$actionResponse = new ActionResponse_Default();

		$actionResponse->setElement('plugin', $plugin);

		return $actionResponse;
	}
}

?>
