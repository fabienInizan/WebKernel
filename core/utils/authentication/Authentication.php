<?php

require_once('core/utils/session/Session.php');
require_once('core/utils/crypto/Crypto.php');
require_once('model/containers/UserContainer.php');
require_once('model/containers/ActionRestrictionContainer.php');
require_once('model/containers/ActionRestrictionExceptionContainer.php');

class Authentication
{

	public static function check(HttpRequest $httpRequest)
	{
		$module = $httpRequest->module;
		$action = $httpRequest->action;
		
		if($module === 'admin' && $action === 'login')
		{
			return;
		}
		
		$session = Session::getInstance();
		
		$userAccessLevel = 0;
		if(!empty($session->auth) && $session->auth && !empty($session->userId))
		{
			$userContainer = UserContainer::getInstance();
			$userId = $session->userId;
			$user = $userContainer->getById($userId);
			$userAccessLevel = $user->getAccessLevel();		
		}
		
		/* Check if there is an action restriction exception */
		$actionRestrictionExceptionContainer = ActionRestrictionExceptionContainer::getInstance();
		try
		{
			$actionRestrictionExceptions = $actionRestrictionExceptionContainer->getByModuleAndAction($module, $action);
			foreach($actionRestrictionExceptions as $actionRestrictionException)
			{
				$exceptionParams = $actionRestrictionException->exceptionStringToArray();
				$exceptionFound = true;
				foreach($exceptionParams as $key=>$value)
				{
					if(!isset($httpRequest->$key) or ($httpRequest->$key != $value))
					{
						$exceptionFound = false;
					}
				}
				if($exceptionFound == true)
				{
					$actionRestrictionAccessLevel = $actionRestrictionException->getAccessLevel();
					break;
				}
			}
		}
		catch(Exception $e)
		{
			$exceptionFound = false;
		}
		
		/* Else apply the default rule */
		if($exceptionFound == false)
		{
			$actionRestrictionContainer = ActionRestrictionContainer::getInstance();
			$actionRestriction = $actionRestrictionContainer->getByModuleAndAction($module, $action);
			$actionRestrictionAccessLevel = $actionRestriction->getAccessLevel();
		}

		if($userAccessLevel < $actionRestrictionAccessLevel)
		{
			header('Location: ?module=admin&action=login');
			exit();
		}
	}
	
	public static function login($login, $password)
	{
		$user = null;
		try
		{
			$userContainer = UserContainer::getInstance();
			$user = $userContainer->getByLoginAndPassword($login, Crypto::cryptPassword($password));
		}
		catch(Exception $e)
		{	echo 'exception : '.$e->getMessage();
			return false;
		}
		
		$session = Session::getInstance();
		$session->auth = true;
		$session->userId = $user->getId();
		
		return true;
	}
	
	/*public static function check($module, $action)
	{
		$restricted = require('config/actions/restricted.php');

		if(empty($restricted[$module]))
		{
			return;
		}

		if(array_search($action, $restricted[$module]) === false)
		{
			return;
		}

		$session = Session::getInstance();

		if(empty($session->auth) || !$session->auth)
		{
			header('Location: ?module=admin&action=login');
			exit();
		}
	}*/

	public static function logout()
	{
		$session = Session::getInstance();
		$session->destroy();
	}
}

?>
