<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/UserContainer.php');
require_once('model/entities/User.php');
require_once('core/utils/crypto/Crypto.php');

class Action_user_edit implements Action
{	
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$userId = $httpRequest->userId;
		$alias = $httpRequest->alias or "";
		$login = $httpRequest->login or "";
		$password = $httpRequest->password or "";
		$accessLevel = $httpRequest->accessLevel or "";
		
		if(isset($userId))
		{
			if(isset($login)		&&
				isset($password)	&&
				isset($accessLevel))
			{
				$userContainer = UserContainer::getInstance();
			
				$user = new User();
				$user->setId($userId);
				$user->setAlias($alias);
				$user->setLogin($login);
				$user->setPassword(Crypto::cryptPassword($password));
				$user->setAccessLevel($accessLevel);
			
				$userContainer->save($user);
			}
			else
			{
				$actionResponse->setElement('warning', 'Impossible to edit the user. Please check you filled all the required fields.');
				$actionResponse->setTemplate('user/displayEditForm');
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
