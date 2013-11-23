<?php

/**
 * Settings resolver
 *
 * @package		spiral
 * @subpackage	core.utils
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface SettingsResolver
{
	/**
	 * Resolve settings from a key
	 * 
	 * @param	string		$key	Settings
	 * @return	Settings
	 */
	public function resolveSettings($key);
}

?>