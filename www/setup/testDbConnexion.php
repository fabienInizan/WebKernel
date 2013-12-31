<?php

$configFilePath = '../../config/config.php';

$dbType = $_POST['dbType'];
$dbName = $_POST['dbName'];
$host = $_POST['host'];
$user = $_POST['user'];
$password = $_POST['password'];
$salt = $_POST['salt']; 

$status = False;
$dbExists = False;

if(isset($salt) && !empty($salt) && (strlen($salt) == 20) && ctype_alnum($salt))
{
	if(
		isset($dbType) && !empty($dbType)		&&
		isset($dbName) && !empty($dbName)		&&
		isset($host) && !empty($host)			&&
		isset($user) && !empty($user)			&&
		isset($password) && !empty($password)
	)
	{
		try
		{
			$pdo = new PDO('mysql:host='.$host, $user, $password);
		
			unset($pdo);
			$status = True;
		}
		catch(Exception $e)
		{
			$status = False;
		}
		
		if($status)
		{
			if(file_exists($configFilePath))
			{
				unlink($configFilePath);
			}
			$config = fopen($configFilePath, 'w');
			fwrite($config, "<?php\n\n");
			fwrite($config, "\t/* Database configuration */\n");
			fwrite($config, "\t\$conf['dbType'] = '".$dbType."';\n");
			fwrite($config, "\t\$conf['dbName'] = '".$dbName."';\n");
			fwrite($config, "\t\$conf['dbHost'] = '".$host."';\n");
			fwrite($config, "\t\$conf['dbUser'] = '".$user."';\n");
			fwrite($config, "\t\$conf['dbPassword'] = '".$password."';\n\n");
			fwrite($config, "\t/* Cryptography configuration */\n");
			fwrite($config, "\t\$conf['cryptoSalt'] = '".$salt."';\n\n");
			fwrite($config, "?>");
			fclose($config);
			header('Location: install.php?step=3');
			exit;
		}
	}
}

header('Location: install.php?step=2&warning=true');
exit;

?>
