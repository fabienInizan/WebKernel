<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/ActionRestrictionExceptionContainer.php');
require_once('model/entities/ActionRestrictionException.php');

class Action_actionRestriction_editException implements Action
{	
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$actionRestrictionExceptionId = $httpRequest->actionRestrictionExceptionId;
		$actionRestrictionExceptionModule = $httpRequest->moduleName;
		$actionRestrictionExceptionAction = $httpRequest->actionName;
		$exceptionString = $httpRequest->exceptionString;
		$description = $httpRequest->description or "";
		$accessLevel = $httpRequest->accessLevel;
		
		$actionRestrictionException = new ActionRestrictionException();
		$actionRestrictionException->setId($actionRestrictionExceptionId);
		$actionRestrictionException->setModule($actionRestrictionExceptionModule);
		$actionRestrictionException->setAction($actionRestrictionExceptionAction);
		$actionRestrictionException->setExceptionString($exceptionString);
		$actionRestrictionException->setDescription($description);
		$actionRestrictionException->setAccessLevel($accessLevel);
		
		if(isset($actionRestrictionExceptionId))
		{
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
				$actionResponse->setElement('warning', 'Impossible to edit the exception. Please check you filled all the required fields with correct values.');
				$actionResponse->setElement('actionRestrictionException', $actionRestrictionException);
				$actionResponse->setTemplateId('actionRestriction/displayEditExceptionForm');
			}
		}
		else
		{
			throw new Exception('The required exception does not exist.');
		}
		
		return $actionResponse;
	}
}

?>
