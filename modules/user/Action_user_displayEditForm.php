<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/entities/User.php');
require_once('model/containers/UserContainer.php');
require_once('model/containers/AccessLevelContainer.php');
require_once('model/entities/AccessLevel.php');

class Action_user_displayEditForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		$userContainer = UserContainer::getInstance();
		
		$userId = $httpRequest->userId;
		
		if(isset($userId))
		{
			$user = $userContainer->getById($userId);
		}
		else
		{
			throw new Exception('The required user does not exist.');
		}
		
		$actionResponse->setElement('user', $user);
		
		$accessLevelContainer = AccessLevelContainer::getInstance();
		
		if($user->getAccessLevel() >= 255)
		{
			$accessLevels = array($accessLevelContainer->getByLevel($user->getAccessLevel()));
		}
		else
		{
			$accessLevels = $accessLevelContainer->getAllButAdmin();
		}
		
		$actionResponse->setElement('accessLevels', $accessLevels);
		
		return $actionResponse;
	}
}
?>
