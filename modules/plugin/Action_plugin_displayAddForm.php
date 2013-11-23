<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/entities/Plugin.php');

class Action_plugin_displayAddForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$id = $httpRequest->pluginId or "";
		$title = $httpRequest->title or "";
		$description = $httpRequest->description or "";
		$version = $httpRequest->version or "";
		$date = $httpRequest->date or "";
		
		$plugin = new Plugin();
		$plugin->setId($id);
		$plugin->setTitle($title);
		$plugin->setDescription($description);
		$plugin->setVersion($version);
		$plugin->setDate($date);
		
		$actionResponse->setElement('plugin', $plugin);
		
		return $actionResponse;
	}
}
?>
