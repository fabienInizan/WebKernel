<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/PageContainer.php');

class Action_page_index implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$pageContainer = PageContainer::getInstance();
		$pages = $pageContainer->getAll();

		$actionResponse = new ActionResponse_Default();

		$actionResponse->setElement('pages', $pages);

		return $actionResponse;
	}
}

?>
