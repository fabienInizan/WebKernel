<?php

class MathHelper
{
	public static function positiveModulo($value, $modulo)
	{
		$result = $value % $modulo;

		if($result < 0)
		$result += $modulo;
			
		return $result;
	}
}

?>