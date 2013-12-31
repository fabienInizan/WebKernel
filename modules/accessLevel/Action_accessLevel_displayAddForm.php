<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/entities/AccessLevel.php');

class Action_accessLevel_displayAddForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$level = $httpRequest->level or "";
		$name = $httpRequest->name or "";
		
		$accessLevel = new AccessLevel();
		$accessLevel->setLevel($level);
		$accessLevel->setName($name);
		
		$actionResponse->setElement('accessLevel', $accessLevel);
		
		return $actionResponse;
	}
}
?>
