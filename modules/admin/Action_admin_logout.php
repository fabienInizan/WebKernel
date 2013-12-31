<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('core/utils/authentication/Authentication.php');

class Action_admin_logout implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		Authentication::logout();

		$actionResponse = new ActionResponse_Default();

		return $actionResponse;
	}
}

?>