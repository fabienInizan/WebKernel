<?php

// Dependencies inclusion
require_once('lib/settings/exceptions/SettingsException.php');

/**
 * Settings file not found
 *
 * @package		spiral
 * @subpackage	core.utils.settings
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
class SettingsException_FileNotFound extends SettingsException {}

/**
 * Settings elements are read only
 *
 * @package		spiral
 * @subpackage	core.utils.settings
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
class SettingsException_ReadOnlyElements extends SettingsException {}

?>