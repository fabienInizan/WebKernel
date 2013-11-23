<?php

require_once('core/resolvers/ViewResolver.php');
require_once('core/view/View_Xhtml.php');

class ViewResolver_Xhtml implements ViewResolver
{
	public function resolveView(HttpRequest $httpRequest, ActionResponse $actionResponse)
	{
		$id = $actionResponse->getTemplateId();

		$fileName = SPIRAL_PATH.'templates/'.$id.'.php';

		return new View_Xhtml($fileName);
	}
}

?>
