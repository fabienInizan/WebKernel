<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/ActionRestrictionExceptionContainer.php');
require_once('model/entities/ActionRestrictionException.php');
require_once('model/containers/AccessLevelContainer.php');

class Action_actionRestriction_addException implements Action
{	
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$actionRestrictionExceptionModule = $httpRequest->moduleName;
		$actionRestrictionExceptionAction = $httpRequest->actionName;
		$exceptionString = $httpRequest->exceptionString;
		$description = $httpRequest->description or "";
		$accessLevel = $httpRequest->accessLevel;
		
		$actionRestrictionException = new ActionRestrictionException();
		$actionRestrictionException->setModule($actionRestrictionExceptionModule);
		$actionRestrictionException->setAction($actionRestrictionExceptionAction);
		$actionRestrictionException->setexceptionString($exceptionString);
		$actionRestrictionException->setDescription($description);
		$actionRestrictionException->setAccessLevel($accessLevel);
		
		if(isset($actionRestrictionExceptionModule) && !empty($actionRestrictionExceptionModule)	&&
			isset($actionRestrictionExceptionAction) && !empty($actionRestrictionExceptionAction)	&&
			isset($exceptionString) && !empty($exceptionString)					&&
			isset($accessLevel))
		{
			$actionRestrictionExceptionContainer = ActionRestrictionExceptionContainer::getInstance();
			$actionRestrictionExceptionContainer->save($actionRestrictionException);
		}
		else
		{
			$actionResponse->setElement('warning', 'Impossible to add the exception. Please check you filled all the required fields with correct values.');
			$actionResponse->setElement('actionRestrictionException', $actionRestrictionException);
			$actionResponse->setTemplateId('actionRestriction/displayAddExceptionForm');
			
			$accessLevelContainer = AccessLevelContainer::getInstance();		
			$accessLevels = $accessLevelContainer->getAll();
		
			$actionResponse->setElement('accessLevels', $accessLevels);
		}
		
		return $actionResponse;
	}
}

?>
