<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/AccessLevelContainer.php');
require_once('model/entities/AccessLevel.php');
require_once('core/utils/crypto/Crypto.php');

class Action_accessLevel_edit implements Action
{	
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$accessLevelId = $httpRequest->accessLevelId;
		$level = $httpRequest->level;
		$name = $httpRequest->name;
		
		$accessLevel = new AccessLevel();
		$accessLevel->setId($accessLevelId);
		$accessLevel->setLevel($level);
		$accessLevel->setName($name);
		
		if(isset($accessLevelId))
		{
			if(isset($level) && !empty($level) && isset($name) && !empty($name) && ($level >= 0) && ($level < 255))
			{
				$accessLevelContainer = AccessLevelContainer::getInstance();			
				$accessLevelContainer->save($accessLevel);
			}
			else
			{
				$actionResponse->setElement('warning', 'Impossible to edit the access level. Please check you filled all the required fields with correct values.');
				$actionResponse->setElement('accessLevel', $accessLevel);
				$actionResponse->setTemplateId('accessLevel/displayEditForm');
			}
		}
		else
		{
			throw new Exception('The required access level does not exist.');
		}
		
		return $actionResponse;
	}
}

?>
