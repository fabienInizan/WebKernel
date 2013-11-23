<?php

$base_dir = '../plugins/restricted';
$suffix = '_restricted.php';

$restricted = array();

$restricted['admin'] = array('index', 'logout', 'phpinfo');
$restricted['plugin'] = array('add', 'delete', 'display', 'displayAddForm', 'displayDeleteForm', 'displayPurgeForm', 'index', 'purge');

$restrictionDir = scandir($base_dir);
foreach($restrictionDir as $restrictionFile)
{
	if(preg_match('#'.$suffix.'$#', $restrictionFile))
	{
		$moduleString = substr($restrictionFile, 0, strrpos($restrictionFile, $suffix));
		$restricted[$moduleString] = include_once($base_dir.'/'.$restrictionFile);
	}
}

return $restricted;

?>
