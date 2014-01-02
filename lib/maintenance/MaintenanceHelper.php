<?php

class MaintenanceHelper
{
	private static $_normalFile = '../www/maintenance.html';
	private static $_maintenanceFile = '../www/index.html';
	
	public static function isMaintenanceMode()
	{
		$isMaintenanceMode = False;
		
		if(file_exists(self::$_normalFile) && !file_exists(self::$_maintenanceFile))
		{
			$isMaintenanceMode = False;
		}
		else if(!file_exists(self::$_normalFile) && file_exists(self::$_maintenanceFile))
		{
			$isMaintenanceMode = True;
		}
		else
		{
			// Unknown state
			throw new Exception('Unable to find maintenance file');
		}
		
		return $isMaintenanceMode;
	}
	
	public static function setMaintenanceMode($active)
	{
		if($active && !self::isMaintenanceMode())
		{
			// Normal mode, switch to maintenance
			if(!rename(self::$_normalFile, self::$_maintenanceFile))
			{
				throw new Exception('Permission issue on maintenance file, renaming failed');
			}
		}
		else if(!$active && self::isMaintenanceMode())
		{
			// Maintenance mode, switch to normal
			if(!rename(self::$_maintenanceFile, self::$_normalFile))
			{
				throw new Exception('Permission issue on maintenance file, renaming failed');
			}
		}
	}
}

?>
