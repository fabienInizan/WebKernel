<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/ActionRestrictionContainer.php');

class Action_actionRestriction_index implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionRestrictionContainer = ActionRestrictionContainer::getInstance();
		$actionRestrictions = $actionRestrictionContainer->getAll();

		$actionResponse = new ActionResponse_Default();

		$actionResponse->setElement('actionRestrictions', $actionRestrictions);

		return $actionResponse;
	}
}

?>
