<?php

// Dependencies inclusion
require_once('lib/collection/Collection.php');

/**
 * Collection of settings
 *
 * @package		spiral
 * @subpackage	core.utils.settings
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface Settings extends Collection
{
	/**
	 * Return sub-settings
	 * 
	 * @param	string		$key	Sub-settings
	 * @return	Settings
	 */
	public function getSubSettings($key);
}

?>