<?php

// Dependencies inclusion
require_once('lib/collection/Collection_Default.php');
require_once('lib/settings/exceptions/SettingsExceptions_FileSystem.php');
require_once('lib/settings/Settings.php');
require_once('lib/settings/resolvers/SettingsResolver_FileSystem.php');

/**
 * Settings from the file system
 *
 * @package		spiral
 * @subpackage	core.utils.settings
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
class Settings_FileSystem extends Collection_Default implements Settings
{
	/**
	 * Key
	 * 
	 * @var	string
	 */
	private $_key;
	
	/**
	 * Settings resolver
	 * 
	 * @var	SettingsResolver
	 */
	private $_settingsResolver;
	
	/**
	 * Constructor
	 * 
	 * @param	string				$path				Settings file to load
	 * @param	string				$key				Key representing the settings location
	 * @param	SettingsResolver	$settingsResolver	Settings resolver
	 * @return	void
	 * 
	 * @throws	SettingsException_FileNotFound
	 */
	public function __construct($path, $key, SettingsResolver_FileSystem $settingsResolver)
	{
		$this->_key = $key;
		$this->_settingsResolver = $settingsResolver;
		
		// Load settings from file
		if(!file_exists($path))
			throw new SettingsException_FileNotFound($path);

		parent::__construct(parse_ini_file($path));
	}
	
	/**
	 * Return sub-settings instance
	 * 
	 * @param	string		$key	Sub-settings
	 * @return	Settings
	 */
	public function getSubSettings($key)
	{
		$key = $this->_key.'.'.$key;
		
		return $this->_settingsResolver->resolveSettings($key);
	}
	
	/**
	 * Remove an element
	 *
	 * @param	string	$name	Element name
	 * @return	void
	 * 
	 * @throws	SettingsException_ReadOnlyElements
	 */
	public function removeElement($name)
	{
		throw new SettingsException_ReadOnlyElements();
	}
	
	/**
	 * Set element value
	 *
	 * @param	string	$name	Element name
	 * @param	mixed	$value	Element value
	 * @return	void
	 * 
	 * @throws	SettingsException_ReadOnlyElements
	 */
	public function setElement($name, $value)
	{
		throw new SettingsException_ReadOnlyElements();
	}
	
	/**
	 * Sets the values of multiple elements
	 *
	 * @param	array	$elements	Elements
	 * @return	void
	 * 
	 * @throws	SettingsException_ReadOnlyElements
	 */
	public function setElements($elements)
	{
		throw new SettingsException_ReadOnlyElements();
	}
}

?>