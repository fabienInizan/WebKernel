<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/UserContainer.php');

class Action_user_delete implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$userId = $httpRequest->userId;
		
		if(!isset($userId))
		{
			throw new Exception('L\'utilisateur demandé n\'existe pas.');
		}
		
		$userContainer = UserContainer::getInstance();		
		$user = $userContainer->getById($userId);
		
		if(!isset($user))
		{
			throw new Exception('L\'utilisateur demandé n\'existe pas.');
		}
		
		if($user->getAccessLevel() >= 255)
		{
			$actionResponse->setElement('warning', 'You tried to delete the master administrator, which is obviously a bad idea as it would likely cause deadlock due to permission management. You can however edit it so you can change the password.');
			$actionResponse->setElement('user', $user);
			$actionResponse->setTemplateId('user/displayDeleteForm');
		}
		else
		{
			$userContainer->delete($user);
		}
	
		return $actionResponse;
	}
}

?>
