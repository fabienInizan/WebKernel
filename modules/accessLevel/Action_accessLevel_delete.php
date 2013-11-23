<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/AccessLevelContainer.php');
require_once('model/containers/UserContainer.php');
require_once('model/containers/ActionRestrictionContainer.php');

class Action_accessLevel_delete implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$accessLevelId = $httpRequest->accessLevelId;
		
		if(!isset($accessLevelId))
		{
			throw new Exception('Le niveau d\'accès demandé n\'existe pas.');
		}
		
		$accessLevelContainer = AccessLevelContainer::getInstance();		
		$accessLevel = $accessLevelContainer->getById($accessLevelId);
		
		if(!isset($accessLevel))
		{
			throw new Exception('Le niveau d\'accès demandé n\'existe pas.');
		}
		
		$userContainer = UserContainer::getInstance();
		$users = array();
		try
		{
			$users = $userContainer->getByAccessLevel($accessLevel->getLevel());
		}
		catch(Exception $e)
		{
		}
		
		if(!empty($users))
		{
			$warning = 'There are existing users with this access level : ';
			foreach($users as $user)
			{
				$alias = $user->getAlias();
				if(empty($alias))
				{
					$alias = 'No alias';
				}
				
				$warning .= $alias.' ('.$user->getLogin().'), ';
			}
			$warning = substr($warning, 0, -2);
			$warning .= '. You should whether edit or delete these users before deleting this access level.';
			
			$actionResponse->setElement('warning', $warning);
			$actionResponse->setElement('accessLevel', $accessLevel);
			$actionResponse->setTemplateId('accessLevel/displayDeleteForm');
		}
		else
		{
			$actionRestrictionContainer = ActionRestrictionContainer::getInstance();
			$actionRestrictions = array();
			try
			{
				$actionRestrictions = $actionRestrictionContainer->getByAccessLevel($accessLevel->getLevel());
			}
			catch(Exception $e)
			{
			}
		
			if(!empty($actionRestrictions))
			{
				$warning = 'There are some actions restrictions that currently use this access level : ';
				foreach($actionRestrictions as $actionRestriction)
				{
					$module = $actionRestriction->getModule();
					$action = $actionRestriction->getAction();
									
					$warning .= '['.$module.' - '.$action.'], ';
				}
				$warning = substr($warning, 0, -2);
				$warning .= '. You should edit all these actions restrictions before deleting this access level.';
			
				$actionResponse->setElement('warning', $warning);
				$actionResponse->setElement('accessLevel', $accessLevel);
				$actionResponse->setTemplateId('accessLevel/displayDeleteForm');
			}
			else
			{
				$accessLevelContainer->delete($accessLevel);
			}
		}
	
		return $actionResponse;
	}
}

?>
