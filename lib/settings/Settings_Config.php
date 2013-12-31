<?php

require_once('lib/collection/Collection_Default.php');
require_once('lib/settings/exceptions/SettingsExceptions_FileSystem.php');
require_once('lib/settings/Settings.php');
require_once('lib/settings/resolvers/SettingsResolver_FileSystem.php');

class Settings_Config extends Collection_Default implements Settings
{
	private static $_instance;
	private $_configFile;
	
	public function __construct()
	{
		$this->_configFile = 'config/config.php';

		try
		{
			require_once($this->_configFile);
		}
		catch(Exception $e)
		{
			throw new SettingsException_FileNotFound($this->_configFile);
		}
			
		if(!isset($conf))
		{
			throw new SettingsException_InvalidContent($this->_configFile);
		}
		
		parent::__construct($conf);
	}
	
	public static function getInstance()
	{
		if(empty(self::$_instance))
		{
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function getSubSettings($key)
	{
		return $this->$key;
	}
	
	public function removeElement($name)
	{
		throw new SettingsException_ReadOnlyElements();
	}
	
	public function setElement($name, $value)
	{
		throw new SettingsException_ReadOnlyElements();
	}
	
	public function setElements($elements)
	{
		throw new SettingsException_ReadOnlyElements();
	}
}

?>
