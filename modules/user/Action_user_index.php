<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/UserContainer.php');

class Action_user_index implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$userContainer = UserContainer::getInstance();
		$users = $userContainer->getAll();

		$actionResponse = new ActionResponse_Default();

		$actionResponse->setElement('users', $users);

		return $actionResponse;
	}
}

?>
