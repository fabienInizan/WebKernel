<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/AccessLevelContainer.php');

class Action_accessLevel_displayDeleteForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$id = $httpRequest->accessLevelId;
		
		$actionResponse = new ActionResponse_Default();
		
		if(isset($id))
		{
			$accessLevelContainer = AccessLevelContainer::getInstance();
			$accessLevel = $accessLevelContainer->getById($id);
			
			if(isset($accessLevel))
			{
				$actionResponse->setElement('accessLevel', $accessLevel);				
			}
			else
			{		
				throw new Exception('Le niveau d\'accès demandé n\'existe pas.');
			}
		}
		else
		{
			throw new Exception('Le niveau d\'accès demandé n\'existe pas.');
		}

		return $actionResponse;
	}
}

?>
