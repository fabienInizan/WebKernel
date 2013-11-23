<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/AccessLevelContainer.php');
require_once('model/containers/ActionRestrictionExceptionContainer.php');

class Action_actionRestriction_displayDeleteExceptionForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$id = $httpRequest->actionRestrictionExceptionId;
		
		if(isset($httpRequest->actionRestrictionExceptionId) && !empty($id))
		{
			$actionRestrictionExceptionContainer = ActionRestrictionExceptionContainer::getInstance();
			$actionRestrictionException = $actionRestrictionExceptionContainer->getById($id);
			
			$actionResponse->setElement('actionRestrictionException', $actionRestrictionException);
		}
		else
		{
			throw new Exception('Unable to find required action restriction exception');
		}
		
		return $actionResponse;
	}
}
?>
