<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/entities/User.php');
require_once('model/containers/AccessLevelContainer.php');

class Action_user_displayAddForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$alias = $httpRequest->alias or "";
		$login = $httpRequest->login or "";
		$password = $httpRequest->password or "";
		$accessLevel = $httpRequest->accessLevel or "";
		
		$user = new User();
		$user->setAlias($alias);
		$user->setLogin($login);
		$user->setPassword($password);
		$user->setAccessLevel($accessLevel);
		
		$actionResponse->setElement('user', $user);
		
		$accessLevelContainer = AccessLevelContainer::getInstance();
		$accessLevels = $accessLevelContainer->getAllButAdmin();
		
		$actionResponse->setElement('accessLevels', $accessLevels);
		
		return $actionResponse;
	}
}
?>
