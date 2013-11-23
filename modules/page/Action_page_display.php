<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/PageContainer.php');

class Action_page_display implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$id = $httpRequest->pageId;

		$pageContainer = PageContainer::getInstance();
		$page = $pageContainer->getById($id);

		$actionResponse = new ActionResponse_Default();

		$actionResponse->setElement('page', $page);

		return $actionResponse;
	}
}

?>