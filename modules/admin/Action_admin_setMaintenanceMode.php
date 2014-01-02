<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('lib/maintenance/MaintenanceHelper.php');

class Action_admin_setMaintenanceMode implements Action
{		
	public function run(HttpRequest $httpRequest)
	{		
		MaintenanceHelper::setMaintenanceMode(True);
		
		$response = new ActionResponse_Default();
		$response->setTemplateId('admin/index');

		return $response;
	}
}

?>
