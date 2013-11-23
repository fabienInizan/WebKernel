<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/AccessLevelContainer.php');

class Action_accessLevel_index implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$accessLevelContainer = AccessLevelContainer::getInstance();
		$accessLevels = $accessLevelContainer->getAll();

		$actionResponse = new ActionResponse_Default();

		$actionResponse->setElement('accessLevels', $accessLevels);

		return $actionResponse;
	}
}

?>
