<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/PageContainer.php');

class Action_page_displayEditForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$id = $httpRequest->pageId;
		
		$actionResponse = new ActionResponse_Default();
		
		if(!empty($id))
		{
			$pageContainer = PageContainer::getInstance();
			$page = $pageContainer->getById($id);
			
			if(!empty($page))
			{
				$actionResponse->setElement('page', $page);				
			}
			else
			{		
				throw new Exception('La page demandée n\'existe pas');
			}
		}
		else
		{
			throw new Exception('La page demandée n\'existe pas');
		}

		return $actionResponse;
	}
}

?>
