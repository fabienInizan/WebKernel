<?php

require_once('core/resolvers/ViewResolver.php');
require_once('core/view/View_Layout.php');
require_once('core/action/ActionResponse_Default.php');

class ViewResolver_Layout implements ViewResolver
{
	private $_viewResolver;
	private $_layoutTemplateId;

	public function __construct(ViewResolver $viewResolver, $layoutTemplateId)
	{
		$this->_viewResolver = $viewResolver;
		$this->_layoutTemplateId = $layoutTemplateId;
	}

	public function resolveView(HttpRequest $httpRequest, ActionResponse $actionResponse)
	{
		$layoutTemplateId = $this->_layoutTemplateId.'/layout';

		$chosenLayout = $actionResponse->getLayout();
		if(!empty($chosenLayout))
		{
			$layoutTemplateId = $chosenLayout;
		}

		$actionResponse->setTemplateId($this->_layoutTemplateId.'/'.$actionResponse->getTemplateId());
		$contentView = $this->_viewResolver->resolveView($httpRequest, $actionResponse);

		$layoutActionResponse = new ActionResponse_Default();
		$layoutActionResponse->setTemplateId($layoutTemplateId);

		$layoutView = $this->_viewResolver->resolveView($httpRequest, $layoutActionResponse);

		return new View_Layout($layoutView, $contentView);
	}
}

?>