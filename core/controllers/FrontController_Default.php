<?php

require_once('core/controllers/FrontController.php');

class FrontController_Default implements FrontController
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
		$action = $this->_actionResolver->resolveAction($httpRequest);
		$actionResponse = $action->run($httpRequest);

		$view = $this->_viewResolver->resolveView($httpRequest, $actionResponse);
		$httpResponse = $view->render($actionResponse->getElements());

		return $httpResponse;
	}
}

?>
