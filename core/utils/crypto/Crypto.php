<?php

require_once('lib/settings/Settings_Config.php');

class Crypto
{
	public static function cryptPassword($password)
	{
		$conf = Settings_Config::getInstance();
		return explode('$', crypt($password, '$2y$12$'.$conf->cryptoSalt.'$'))[4];
	}
}

?>
