<?php

// Dependencies inclusion
require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');

class Action_admin_index implements Action
{		
	public function run(HttpRequest $httpRequest)
	{		
		$base_dir = '../plugins/adminMenu';
		$suffix = '_adminMenu.php';
	
		$response = new ActionResponse_Default();
		
		$adminMenu = array();

		$adminMenuDir = scandir($base_dir);
		foreach($adminMenuDir as $adminMenuFile)
		{
			if(preg_match('#'.$suffix.'$#', $adminMenuFile))
			{
				$module = substr($adminMenuFile, 0, strrpos($adminMenuFile, $suffix));
				$adminMenu[$module] = include_once($base_dir.'/'.$adminMenuFile);
			}
		}
		
		$response->setElement('adminMenu', $adminMenu);

		return $response;
	}
}

?>
