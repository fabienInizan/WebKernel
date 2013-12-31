<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/PluginContainer.php');
require_once('model/entities/Plugin.php');
require_once('core/utils/filesystem/FileSystem.php');

class Action_plugin_add implements Action
{	
	private function _uploadPluginArchive($base, $pluginArchive)
	{
		$archive = $base.'/'.basename($pluginArchive['name']);
		if(($pluginArchive['type'] != 'application/zip') && ($pluginArchive['type'] != 'application/x-zip-compressed'))
		{
			throw new Exception('Bad file format : ZIP expected (extension .zip)');
		}
		
		if((fileperms($base) & 0777) != 0777)
		{
			chmod($base, 0777);
		}
	
		if(!move_uploaded_file($pluginArchive['tmp_name'], $archive))
		{
			throw new Exception('Impossible to upload '.$pluginArchive['name'].' to '.$archive);
		}
		
		$zip = new ZipArchive();
		if(!$zip->open($archive))
		{
			unlink($archive);
			$zip->close();
			throw new Exception('Invalid archive '.$pluginArchive['name']);
		}
		
		$pluginDir = $base.'/'.basename($pluginArchive['name'], '.zip');
		
		if((fileperms($pluginDir) & 0777) != 0777)
		{
			chmod($pluginDir, 0777);
		}
		
		if(!$zip->extractTo($pluginDir))
		{
			unlink($archive);
			$zip->close();
			throw new Exception('Unable to extract archive '.$pluginArchive['name']);
		}
		
		unlink($archive);
		$zip->close();
		
		return $pluginDir;
	}
	
	private function _checkPluginInfo($info)
	{
		return (!empty($info['id']) &&
			!empty($info['title']) &&
			!empty($info['description']) &&
			!empty($info['version']) &&
			!empty($info['date']));
	}
	
	private function _checkUnicity($info)
	{
		$pluginContainer = PluginContainer::getInstance();
		$double = NULL;
		
		try
		{
			$double = $pluginContainer->getById($info['id']);
		}
		catch(Exception $e)
		{
			// Ignore
		}
		
		return ($double == NULL);		
	}
	
	private function _installDatabase($pluginDir, $pluginId)
	{
		$dbHelperClass = '__'.$pluginId.'DbHelper';
		$dbHelperInclude = $pluginDir.'/'.$dbHelperClass.'.php';
		
		if(!is_file($dbHelperInclude))
		{
			throw new Exception('Malformed plugin archive, missing '.$dbHelperInclude);
		}
		
		require_once($dbHelperInclude);
		$dbHelper = $dbHelperClass::getInstance();
		
		try
		{
			$dbHelper->dbInstall();
		}
		catch(Exception $e)
		{
			throw new Exception('Installation error : unable to install database');
		}
	}
	
	private function _makeDirs($pluginDir, $dirs)
	{
		foreach($dirs as $dirParent=>$dirName)
		{
			$dirPath = '../'.$dirParent.'/'.$dirName;
			if(!is_dir($dirPath))
			{
				mkdir($dirPath, 0777, true);
			}
			else
			{
				if((fileperms($dirPath) & 0777) != 0777)
				{
					chmod($dirPath, 0777);
				}
			}
		}
	}
	
	private function _copyFiles($pluginDir, $files)
	{
		foreach($files as $src=>$dst)
		{
			$srcPath = $pluginDir.'/'.$src;
			$dstPath = '../'.$dst;	
			
			try
			{
				FileSystem::move($srcPath, $dstPath, true);
			}
			catch(Exception $e)
			{	
				echo "Exception\n";
				echo $e->getMessage();
			}
		}
	}
	
	private function _installAdminMenu($pluginDir, $pluginId)
	{
		$adminMenuFile = $pluginDir.'/'.$pluginId.'_adminMenu.php';
		$dstPath = '../plugins/adminMenu/'.$pluginId.'_adminMenu.php';

		try
		{
			FileSystem::move($adminMenuFile, $dstPath, true);
		}
		catch(Exception $e)
		{
			echo "Exception\n";
			echo $e->getMessage();
		}
	}
	
	private function _registerPlugin($pluginDir, $info)
	{
		$pluginContainer = PluginContainer::getInstance();
		
		$plugin = new Plugin();
		$plugin->setId($info['id']);
		$plugin->setTitle($info['title']);
		$plugin->setDescription($info['description']);
		$plugin->setVersion($info['version']);
		$plugin->setDate($info['date']);
		$plugin->setPath($pluginDir);
		
		$pluginContainer->save($plugin);
	}
	
	public function run(HttpRequest $httpRequest)
	{
		$base = '../plugins';
		
		$actionResponse = new ActionResponse_Default();
		
		$pluginArchive = $httpRequest->pluginArchive;
		if(!empty($pluginArchive))
		{
			$pluginDir = $this->_uploadPluginArchive($base, $pluginArchive);

			$infoFile = $pluginDir.'/__info.php';
			if(!is_file($infoFile))
			{
				throw new Exception('Plugin archive corrupted : missing plugin info');
			}
			
			$info = include_once($pluginDir.'/__info.php');
			if(!$this->_checkPluginInfo($info))
			{
				throw new Exception('Plugin archive corrupted : invalid plugin info');
			}

			$pluginContainer = PluginContainer::getInstance();
			if(!$this->_checkUnicity($info))
			{
				throw new Exception('This plugin is already installed');
			}
			
			$this->_installDatabase($pluginDir, $info['id']);
			
			$mkdirFile = $pluginDir.'/__mkdir.php';
			if(!is_file($mkdirFile))
			{
				throw new Exception('Plugin archive corrupted : missing plugin directories list');
			}
			
			$dirs = include_once($mkdirFile);			
			$this->_makeDirs($pluginDir, $dirs);
			
			$filesFile = $pluginDir.'/__files.php';
			if(!is_file($filesFile))
			{
				throw new Exception('Plugin archive corrupted : missing plugin files list');
			}
			
			$files = include_once($filesFile);			
			$this->_copyFiles($pluginDir, $files);
			
			$this->_installAdminMenu($pluginDir, $info['id']);
			
			$this->_registerPlugin($pluginDir, $info);
		}
		else
		{		
			$actionResponse->setElement('warning', 'Vous devez choisir l`archive ZIP du plugin à installer.');
			$actionResponse->setTemplateId('plugin/displayAddForm');
		}
		
		return $actionResponse;
	}
}

?>
