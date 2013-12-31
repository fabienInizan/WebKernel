<?php

require_once('core/resolvers/ActionResolver.php');
require_once('core/utils/authentication/Authentication.php');

class ActionResolver_Default implements ActionResolver
{
	private $_defaultModule;
	private $_defaultAction;
	private $_params;

	public function __construct($defaultModule, $defaultAction, array $params = array())
	{
		$this->_defaultModule = $defaultModule;
		$this->_defaultAction = $defaultAction;
		$this->_params = $params;
	}

	public function resolveAction(HttpRequest $httpRequest)
	{
		$module = $httpRequest->module;
		$action = $httpRequest->action;

		if(empty($module))
		{
			$module = $this->_defaultModule;
			$action = $this->_defaultAction;
				
			$httpRequest->module = $module;
			$httpRequest->action = $action;
				
			foreach($this->_params as $key=>$value)
			$httpRequest->$key = $value;
		}

		if(empty($action))
		{
			$action = 'index';
			$httpRequest->action = $action;
		}

		Authentication::check($httpRequest);

		$className = 'Action_'.$module.'_'.$action;

		if(!class_exists($className))
		{
			$fileName = SPIRAL_PATH.'modules/'.$module.'/'.$className.'.php';

			if(!is_file($fileName))
			{
				throw new Exception('Cannot find action : '.$className);
			}

			require_once($fileName);
	
			if(!class_exists($className))
			{
				throw new Exception('File "'.$fileName.'" does not contain class "'.$className.'"');
			}
		}

		return new $className();
	}
}

?>
