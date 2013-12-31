<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/AccessLevelContainer.php');
require_once('model/entities/AccessLevel.php');

class Action_accessLevel_displayEditForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$accessLevelId = $httpRequest->accessLevelId;
		
		if(isset($accessLevelId))
		{
			$accessLevelContainer = AccessLevelContainer::getInstance();
			$accessLevel = $accessLevelContainer->getById($accessLevelId);
		}
		else
		{
			throw new Exception('The required access level does not exist.');
		}
		
		$actionResponse->setElement('accessLevel', $accessLevel);
		
		return $actionResponse;
	}
}
?>
