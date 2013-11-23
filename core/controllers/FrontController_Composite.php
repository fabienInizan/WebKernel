<?php

require_once('core/controllers/FrontController.php');
require_once('core/action/ActionResponse_Default.php');
require_once('core/http/HttpRequest_String.php');

class FrontController_Composite implements FrontController
{
	public $_actionResolver;
	public $_viewResolver;

	public function __construct(ActionResolver $actionResolver, ViewResolver $viewResolver)
	{
		$this->_actionResolver = $actionResolver;
		$this->_viewResolver = $viewResolver;
	}

	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		if($httpRequest->module == 'composite')
		{
			$list = explode(' ', $httpRequest->list);
			foreach($list as $stringRequest)
			{
				$request = new HttpRequest_String($stringRequest);
				$action = $this->_actionResolver->resolveAction($request);
				$actionResponseTmp = $action->run($request);
				$actionResponse->addElements($actionResponseTmp->getElements());
			}
			$actionResponse->setTemplateId('composite/'.$httpRequest->templateId);
		}
		else
		{		
			$action = $this->_actionResolver->resolveAction($httpRequest);
			$actionResponse = $action->run($httpRequest);
		}

		$view = $this->_viewResolver->resolveView($httpRequest, $actionResponse);
		$httpResponse = $view->render($actionResponse->getElements());

		return $httpResponse;
	}
}

?>
