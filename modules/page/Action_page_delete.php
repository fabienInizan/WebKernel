<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/PageContainer.php');

class Action_page_delete implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$id = $httpRequest->pageId;

		$pageContainer = PageContainer::getInstance();
		$page = $pageContainer->getById($id);
		
		if(!empty($page))
		{
			$pageContainer->delete($page);
		}

		$actionResponse = new ActionResponse_Default();
		$actionResponse->setTemplateId('page/index');

		return $actionResponse;
	}
}

?>
