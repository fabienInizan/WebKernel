<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');

class Action_admin_phpinfo implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		return new ActionResponse_Default();
	}
}

?>
