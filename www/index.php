<?php

require_once('../core/ini.php');
require_once('core/resolvers/ActionResolver_Default.php');
require_once('core/resolvers/ViewResolver_Default.php');
require_once('core/resolvers/ViewResolver_Xhtml.php');
require_once('core/resolvers/ViewResolver_Layout.php');
require_once('core/controllers/FrontController_Composite.php');
require_once('core/http/HttpRequest_Default.php');
require_once('core/http/HttpRequest_String.php');

function _load($httpRequest, $module, $action, $params)
{
	$spiralMode = 'public';
	if(!empty($httpRequest->spiralMode) && $httpRequest->spiralMode == 'admin')
	{
		$spiralMode = 'admin';
	}

	if($spiralMode == 'public')
	{
		$defaultModule = $module;
		$defaultAction = $action;
		$defaultParams = $params;
	}
	else
	{
		$defaultModule = 'admin';
		$defaultAction = 'login';
		$defaultParams = array();
	}

	$actionResolver = new ActionResolver_Default($defaultModule, $defaultAction, $defaultParams);

	$viewResolver = new ViewResolver_Default();
	$viewResolver_Xhtml = new ViewResolver_Xhtml();
	$viewResolver_Layout = new ViewResolver_Layout($viewResolver_Xhtml, $spiralMode);
	$viewResolver->setViewResolver('xhtml', $viewResolver_Layout);

	$frontController = new FrontController_Composite($actionResolver, $viewResolver);

	$httpResponse = $frontController->run($httpRequest);
	$httpResponse->send();
}

try
{
	$httpRequest = new HttpRequest_Default();
	_load($httpRequest, 'page', 'display', array('pageId'=>'index'));

}
catch(Exception $e)
{
	/* Tweak : this dirty tweak is intended to try loading an error 404 page while stacking the current exception for later trace */
	try
	{
		$noPage = false;
		$httpRequest = new HttpRequest_String("module=page;action=display;pageId=404");
		_load($httpRequest, 'page', 'display', array('pageId'=>'index'));
	}
	catch(Exception $dummy)
	{
		$noPage = true;
	}
	
	if($noPage == true)
	{
		/* Pop the previous exception */
?>
		<h1>Exception</h1>

		<p><?php echo $e->getMessage(); ?></p>

		<p><?php echo $e->getTraceAsString(); ?></p>

		<p>In <strong><?php echo $e->getFile(); ?></strong> on line <?php echo $e->getLine(); ?>.</p>
<?php
	}
}
?>
