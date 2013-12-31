<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/ActionRestrictionExceptionContainer.php');
require_once('model/entities/ActionRestrictionException.php');

class Action_actionRestriction_deleteException implements Action
{	
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$actionRestrictionExceptionId = $httpRequest->actionRestrictionExceptionId;
		
		if(isset($actionRestrictionExceptionId))
		{
			$actionRestrictionExceptionContainer = ActionRestrictionExceptionContainer::getInstance();
			$actionRestrictionException = $actionRestrictionExceptionContainer->getById($actionRestrictionExceptionId);
			$actionRestrictionExceptionContainer->delete($actionRestrictionException);
		}
		else
		{
			throw new Exception('The required exception does not exist.');
		}
		
		return $actionResponse;
	}
}

?>
