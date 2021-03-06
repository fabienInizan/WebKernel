<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/UserContainer.php');
require_once('model/entities/User.php');
require_once('core/utils/crypto/Crypto.php');

class Action_user_add implements Action
{	
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$alias = $httpRequest->alias;
		$login = $httpRequest->login;
		$password = $httpRequest->password;
		$accessLevel = $httpRequest->accessLevel;
		
		if(isset($login)		&&
			isset($password)	&&
			isset($accessLevel))
		{
			$userContainer = UserContainer::getInstance();
			
			$user = new User();
			$user->setAlias($alias);
			$user->setLogin($login);
			$user->setPassword(Crypto::cryptPassword($password));
			$user->setAccessLevel($accessLevel);
			
			$userContainer->save($user);
		}
		else
		{
			$actionResponse->setElement('warning', 'Impossible to create the user. Please check you filled all the required fields.');
			$actionResponse->setTemplateId('user/displayAddForm');
		}
		
		return $actionResponse;
	}
}

?>
