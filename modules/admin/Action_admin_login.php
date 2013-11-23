<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('core/utils/authentication/Authentication.php');

class Action_admin_login implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$user = $httpRequest->user;
		$password = $httpRequest->password;

		$actionResponse = new ActionResponse_Default();

		if(!empty($user) && !empty($password))
		{
			if(Authentication::login($user, $password))
			{
				header('Location: ?module=admin');
			}
			else
			{
				$actionResponse->setElement('message', 'Le nom d\'utilisateur ou le mot de passe est incorrect.');
			}
		}

		return $actionResponse;
	}
}

?>