<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/entities/ActionRestriction.php');
require_once('model/containers/ActionRestrictionContainer.php');
require_once('model/containers/AccessLevelContainer.php');
require_once('model/entities/AccessLevel.php');

class Action_actionRestriction_displayEditForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		$actionRestrictionContainer = ActionRestrictionContainer::getInstance();
		
		$actionRestrictionId = $httpRequest->actionRestrictionId;
		
		if(isset($actionRestrictionId))
		{
			$actionRestriction = $actionRestrictionContainer->getById($actionRestrictionId);
		}
		else
		{
			throw new Exception('The required action restriction does not exist.');
		}
		
		$actionResponse->setElement('actionRestriction', $actionRestriction);
		
		$accessLevelContainer = AccessLevelContainer::getInstance();		
		$accessLevels = $accessLevelContainer->getAll();
		
		$actionResponse->setElement('accessLevels', $accessLevels);
		
		return $actionResponse;
	}
}
?>
