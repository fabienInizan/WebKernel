<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/UserContainer.php');

class Action_user_displayDeleteForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$id = $httpRequest->userId;
		
		$actionResponse = new ActionResponse_Default();
		
		if(isset($id))
		{
			$userContainer = UserContainer::getInstance();
			$user = $userContainer->getById($id);
			
			if(isset($user))
			{
				$actionResponse->setElement('user', $user);				
			}
			else
			{		
				throw new Exception('L\'utilisateur demandé n\'existe pas.');
			}
		}
		else
		{
			throw new Exception('L\'utilisateur demandé n\'existe pas.');
		}

		return $actionResponse;
	}
}

?>
