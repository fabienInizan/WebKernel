<?php

require_once('core/resolvers/ViewResolver.php');

class ViewResolver_Default implements ViewResolver
{
	private $_viewResolvers;

	public function resolveView(HttpRequest $httpRequest, ActionResponse $actionResponse)
	{
		$id = $actionResponse->getTemplateId();

		if(empty($id))
		{
			$module = $httpRequest->module;
			$action = $httpRequest->action;
				
			$id = $module.'/'.$action;
			$actionResponse->setTemplateId($id);
		}

		$type = $actionResponse->getTemplateType();

		if(empty($type))
		{
			$type = 'xhtml';
			$actionResponse->setTemplateType($type);
		}

		$viewResolver = $this->_viewResolvers[$type];

		if(empty($viewResolver))
		{
			throw new Exception('Undefined resolver for "'.$type.'" template type.');
		}

		return $viewResolver->resolveView($httpRequest, $actionResponse);
	}

	public function setViewResolver($type, ViewResolver $viewResolver)
	{
		$this->_viewResolvers[$type] = $viewResolver;
	}
}

?>