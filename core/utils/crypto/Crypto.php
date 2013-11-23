<?php

class Crypto
{
	public static function cryptPassword($password)
	{
		return explode('$', crypt($password, '$2y$12$webKernelSaltedCrypt$'))[4];
	}
}

?>
