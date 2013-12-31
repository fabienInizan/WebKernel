<?php

class DateHelper
{
	private static $_monthNames = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

	public static function getMonthName($number)
	{
		return self::$_monthNames[$number-1];
	}

	// Convert from string db date (ex: '2002-05-24') to a french readable sentence
	// If helper get an impossible date (ex: '0000-00-00'), it will return a null sentence
	public static function formatDate($date)
	{
		$sentence = '';

		$fields = explode('-', $date);

		if ( !($fields[1] <= 0 || $fields[2] <= 0) && !($fields[1] > 12 || $fields[2] > 31) )
		{
			$sentence = 'Le '.$fields[2].' '.DateHelper::getMonthName($fields[1]).' '.$fields[0];
		}

		return $sentence;
	}
}

?>
