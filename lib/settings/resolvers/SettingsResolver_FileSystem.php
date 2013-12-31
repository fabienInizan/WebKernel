<?php

// Dependencies inclusion
require_once('lib/settings/resolvers/Resolver_FileSystem.php');
require_once('lib/settings/resolvers/SettingsResolver.php');
require_once('lib/settings/Settings_FileSystem.php');

/**
 * Settings resolver from file system
 *
 * @package		spiral
 * @subpackage	core.utils.settings.resolvers
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
class SettingsResolver_FileSystem extends Resolver_FileSystem implements SettingsResolver
{
	/**
	 * Constructor
	 * 
	 * @param	string		$path			Path where files are located
	 * @param	string		$filePrefix		File prefix
	 * @param	string		$fileSuffix		File suffix
	 * @return	void
	 */
	public function __construct($path = 'config', $filePrefix = '', $fileSuffix = '.ini.php')
	{
		parent::__construct($path, '', '', $filePrefix, $fileSuffix);
	}
	
	/**
	 * Decode a key to a path
	 *
	 * Transform a key of type "db.profils"
	 * to a path of type "config/db/profils.ini.php"
	 *
	 * @param	string		$key	Key to decode
	 * @return	string
	 */
	private function _decodeKey($key)
	{
		return $this->_getPath().'/'.$this->_getFilePrefix().str_replace('.', '/', $key).$this->_getFileSuffix();
	}
	
	/**
	 * Resolve settings from a key
	 * 
	 * @param	string		$key	Settings
	 * @return	Settings
	 */
	public function resolveSettings($key)
	{
		return new Settings_FileSystem($this->_decodeKey($key), $key, $this);
	}
}

?>