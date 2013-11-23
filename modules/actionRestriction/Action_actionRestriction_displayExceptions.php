<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/AccessLevelContainer.php');
require_once('model/containers/ActionRestrictionExceptionContainer.php');

class Action_actionRestriction_displayExceptions implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$module = $httpRequest->moduleName;
		$action = $httpRequest->actionName;
		
		if(isset($httpRequest->module) && !empty($module) &&
			isset($httpRequest->action) && !empty($action))
		{
			$actionRestrictionExceptionContainer = ActionRestrictionExceptionContainer::getInstance();
			$actionRestrictionExceptions = $actionRestrictionExceptionContainer->getByModuleAndAction($module, $action);
			$actionResponse->setElement('actionRestrictionExceptions', $actionRestrictionExceptions);
			$actionResponse->setElement('module', $module);
			$actionResponse->setElement('action', $action);
		}
		
		return $actionResponse;
	}
}
?>
