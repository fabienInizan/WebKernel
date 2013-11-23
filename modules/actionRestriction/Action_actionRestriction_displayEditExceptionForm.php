<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/entities/ActionRestriction.php');
require_once('model/containers/ActionRestrictionExceptionContainer.php');
require_once('model/containers/AccessLevelContainer.php');
require_once('model/entities/AccessLevel.php');

class Action_actionRestriction_displayEditExceptionForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		$actionRestrictionExceptionContainer = ActionRestrictionExceptionContainer::getInstance();
		
		$actionRestrictionExceptionId = $httpRequest->actionRestrictionExceptionId;
		
		if(isset($actionRestrictionExceptionId))
		{
			$actionRestrictionException = $actionRestrictionExceptionContainer->getById($actionRestrictionExceptionId);
		}
		else
		{
			throw new Exception('The required action restriction exception does not exist.');
		}
		
		$actionResponse->setElement('actionRestrictionException', $actionRestrictionException);
		
		$accessLevelContainer = AccessLevelContainer::getInstance();		
		$accessLevels = $accessLevelContainer->getAll();
		
		$actionResponse->setElement('accessLevels', $accessLevels);
		
		return $actionResponse;
	}
}
?>
