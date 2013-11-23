<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/AccessLevelContainer.php');
require_once('model/entities/ActionRestrictionException.php');

class Action_actionRestriction_displayAddExceptionForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$module = $httpRequest->moduleName;
		$action = $httpRequest->actionName;
		
		if(isset($httpRequest->module) && !empty($module) &&
			isset($httpRequest->action) && !empty($action))
		{
			$actionRestrictionException = new ActionRestrictionException();
			$actionRestrictionException->setModule($module);
			$actionRestrictionException->setAction($action);
			$actionResponse->setElement('actionRestrictionException', $actionRestrictionException);
		}
		else
		{
			throw new Exception('No module/action specified');
		}
		
		$accessLevelContainer = AccessLevelContainer::getInstance();		
		$accessLevels = $accessLevelContainer->getAll();
		
		$actionResponse->setElement('accessLevels', $accessLevels);
		
		return $actionResponse;
	}
}
?>
