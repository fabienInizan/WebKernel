<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/entities/Page.php');

class Action_page_displayAddForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$id = $httpRequest->pageId or "";
		$title = $httpRequest->title or "";
		$content = $httpRequest->content or "";
		
		$page = new Page();
		$page->setId($id);
		$page->setTitle($title);
		$page->setContent($content);
		
		$actionResponse->setElement('page', $page);
		
		return $actionResponse;
	}
}
?>
