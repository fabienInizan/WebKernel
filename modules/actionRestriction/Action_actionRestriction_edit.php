<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/ActionRestrictionContainer.php');
require_once('model/entities/ActionRestriction.php');

class Action_actionRestriction_edit implements Action
{	
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$actionRestrictionId = $httpRequest->actionRestrictionId;
		$actionRestrictionModule = $httpRequest->actionRestrictionModule;
		$actionRestrictionAction = $httpRequest->actionRestrictionAction;
		$description = $httpRequest->description or "";
		$accessLevel = $httpRequest->accessLevel;
		
		if(isset($actionRestrictionId))
		{
			if(isset($actionRestrictionModule)	&&
				isset($actionRestrictionAction) &&
				isset($accessLevel))
			{
				$actionRestrictionContainer = ActionRestrictionContainer::getInstance();
			
				$actionRestriction = new ActionRestriction();
				$actionRestriction->setId($actionRestrictionId);
				$actionRestriction->setModule($actionRestrictionModule);
				$actionRestriction->setAction($actionRestrictionAction);
				$actionRestriction->setDescription($description);
				$actionRestriction->setAccessLevel($accessLevel);
			
				$actionRestrictionContainer->save($actionRestriction);
			}
			else
			{
				$actionResponse->setElement('warning', 'Impossible to edit the action restriction. Please check you filled all the required fields with correct values.');
				$actionResponse->setTemplateId('actionRestriction/displayEditForm');
			}
		}
		else
		{
			throw new Exception('The required action restriction does not exist.');
		}
		
		return $actionResponse;
	}
}

?>
