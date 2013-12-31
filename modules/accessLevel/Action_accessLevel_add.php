<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/AccessLevelContainer.php');
require_once('model/entities/AccessLevel.php');

class Action_accessLevel_add implements Action
{	
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$level = $httpRequest->level;
		$name = $httpRequest->name;
		
		$accessLevel = new accessLevel();
		$accessLevel->setLevel($level);
		$accessLevel->setName($name);
		
		if(isset($level) && isset($name) && ($level >= 0) && ($level < 255))
		{
			$accessLevelContainer = AccessLevelContainer::getInstance();
						
			// Check for doubles
			$double = null;
			try
			{
				$double = $accessLevelContainer->getByLevel($level);
			}
			catch(Exception $e)
			{
			
			}
			
			if(!empty($double))
			{
				$actionResponse->setElement('warning', 'Another access level with the same permission exists. Please change the access level number.');
				$actionResponse->setElement('accessLevel', $accessLevel);
				$actionResponse->setTemplateId('accessLevel/displayAddForm');				
			}
			else
			{			
			
				$accessLevelContainer->save($accessLevel);
			}
		}
		else
		{
			$actionResponse->setElement('warning', 'Impossible to create the access level. Please check you filled all the required fields with correct values.');
			$actionResponse->setElement('accessLevel', $accessLevel);
			$actionResponse->setTemplateId('accessLevel/displayAddForm');
		}
		
		return $actionResponse;
	}
}

?>
