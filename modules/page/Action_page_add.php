<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/PageContainer.php');
require_once('model/entities/Page.php');

class Action_page_add implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$id = $httpRequest->pageId;
		$actionResponse = new ActionResponse_Default();

		if(!empty($id))
		{
			$pageContainer = PageContainer::getInstance();
			try
			{
				$double = $pageContainer->getById($id);
			}
			catch(Exception $e)
			{
				$double = null;
			}
			
			if(!empty($double))
			{
				$actionResponse->setElement('warning', 
					'Une page utilisant le même identifiant existe déjà. Modifiez la page existante ou modifiez le champ d\'identifiant pour créer une nouvelle page');
				$actionResponse->setTemplateId('page/displayAddForm');
			}
			else
			{
				$page = new Page();
				$page->setId($id);
				$page->setTitle($httpRequest->title);
				$page->setContent($httpRequest->content);
				
				$pageContainer->save($page);
			}			
		}
		else
		{
			$actionResponse->setElement('warning', 
					'Le champ d\'identifiant est obligatoire.');
			$actionResponse->setTemplateId('page/displayAddForm');
		}

		return $actionResponse;
	}
}

?>
